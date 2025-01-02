<?php

namespace App\Infrastructure\Repositories;

use App\Core\Interfaces\FaltasRepositoryInterface;

use App\Infrastructure\Models\Falta;
use App\Infrastructure\Models\Funcionario;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Support\Carbon;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class FaltasRepository implements FaltasRepositoryInterface
{

    public function createFaltas(array $data): Falta
    {
   
            // Extraímos as datas de início e fim da nova falta
            $data_inicio = $data['data_inicio'];
            $data_fim = $data['data_fim'];
            $funcionario_id = $data['funcionario_id']; // ID do funcionário
        
            // Verifica se já existe alguma falta para o mesmo funcionário com datas sobrepondo as novas
            $sobreposicao = Falta::where('funcionario_id', $funcionario_id)
                ->where(function ($query) use ($data_inicio, $data_fim) {
                    $query->whereBetween('data_inicio', [$data_inicio, $data_fim])
                        ->orWhereBetween('data_fim', [$data_inicio, $data_fim])
                        ->orWhere(function ($query) use ($data_inicio, $data_fim) {
                            $query->where('data_inicio', '<=', $data_inicio)
                                ->where('data_fim', '>=', $data_fim);
                        });
                })
                ->exists();
        
            if ($sobreposicao) {


                $datas = 'A data de início não pode ser maior que a data de fim. Por favor, verifique as datas';
                
                dd($datas);

        
            }
        
            // Cria a falta no banco de dados
            return Falta::create($data);
        
       



    }

    public function handleError( $e)
    {
        // Retorna a view de erro com a mensagem da exceção
        return response()->view('funcionarios.errors', [
            'message' => $e->getMessage()
        ], 500); // Retorna erro 500
    }

    public function getFaltasByFuncionario(): Collection
    {
         // Recupera o token da sessão
    $token = session('token');
    //  dd( $token );
  
      if (!$token) {
          return redirect()->route('login.form')->with('error', 'Você precisa estar logado.');
      }
  
      // Agora você pode realizar a lógica com o token, como buscar o usuário autenticado
      try {
          $user = JWTAuth::setToken($token)->authenticate();
      } catch (JWTException $e) {
          return redirect()->route('login.form')->with('error', 'Token inválido ou expirado.');
      }
  
      
        return Falta::with('funcionario')->get();
    }



    public function deletefaltas(int $idfaltas): bool
    {
        // Buscar o registro da falta pelo ID fornecido
        $buscarfunc = Falta::find($idfaltas);

        // Verificar se o registro da falta foi encontrado
        if ($buscarfunc) {
            // Obter o ID do funcionário associado à falta
            $idFuncionario = $buscarfunc->funcionario_id;

            // Obter o valor de 'countfaltas' da falta
            $contagem = $buscarfunc->countfaltas;

            // Buscar o registro do funcionário correspondente
            $funcionario = Funcionario::find($idFuncionario);

            // Verificar se o funcionário foi encontrado
            if ($funcionario) {
                // Verificar se a falta está ativa
                if ($buscarfunc->aprovacao == 'Ativado') {
                    // Calcular o valor a ser subtraído da coluna 'desconto'
                    $valorSubtraido = $contagem * 3000;

                    // Subtrair o valor calculado da coluna 'desconto'
                    $funcionario->desconto = $funcionario->desconto - $valorSubtraido;

                    // Verifica se o resultado é negativo e é um número
                 /*   if (is_numeric($funcionario->desconto) && $funcionario->desconto < 0) {

                        echo "O resultado é negativo.";
                    } else {
                        echo "O resultado não é negativo.";
                    }*/

                    // Salvar as alterações no banco de dados para o funcionário
                    $funcionario->save();
                } else {

                    if ($buscarfunc->aprovacao == '') {
                        // Deletar o registro da falta após a verificação
                        $buscarfunc->delete();
                    }
                }
            }

            // Deletar o registro da falta após a verificação
            $buscarfunc->delete();

            return true;
        }

        // Caso o registro da falta não tenha sido encontrado, retornar false
        return false;
    }


    public function funcionarioEmfalta(int $id): Falta
    {
        $data = Falta::find($id);

        return  $data;
    }

    public function editarfaltas(int $editId, array $dados): Falta
    {
        try {
            // Encontrar o dado a ser editado
            $dadoAeditar = Falta::findOrFail($editId);

            // Extraímos as datas de início e fim da nova falta, mantendo as existentes caso não haja mudança
            $data_inicio = isset($dados['data_inicio']) ? $dados['data_inicio'] : $dadoAeditar->data_inicio;
            $data_fim = isset($dados['data_fim']) ? $dados['data_fim'] : $dadoAeditar->data_fim;
            $funcionario_id = $dadoAeditar->funcionario_id; // ID do funcionário

            // Verifica se a data de início não é maior que a data de fim
            if (Carbon::parse($data_inicio)->gt(Carbon::parse($data_fim))) {
                 $datas = 'A data de início não pode ser maior que a data de fim. Por favor, verifique as datas';
                 dd($datas);
                throw new \Exception('A data de início não pode ser maior que a data de fim. Por favor, verifique as datas.');
            }

            // Verifica se as novas datas são diferentes das atuais
            if ($data_inicio !== $dadoAeditar->data_inicio || $data_fim !== $dadoAeditar->data_fim) {
                // Verifica se já existe alguma falta para o mesmo funcionário com datas sobrepondo as novas
                $sobreposicao = Falta::where('funcionario_id', $funcionario_id)
                    ->where(function ($query) use ($data_inicio, $data_fim) {
                        // Verifica se a nova falta se sobrepõe com uma falta existente
                        $query->whereBetween('data_inicio', [$data_inicio, $data_fim])  // A data_inicio da nova falta está entre as datas da falta existente
                            ->orWhereBetween('data_fim', [$data_inicio, $data_fim])  // A data_fim da nova falta está entre as datas da falta existente
                            ->orWhere(function ($query) use ($data_inicio, $data_fim) {
                                // Verifica se a nova falta engloba uma falta existente
                                $query->where('data_inicio', '<=', $data_inicio)  // A data_inicio da falta existente é antes da data_inicio da nova falta
                                    ->where('data_fim', '>=', $data_fim); // A data_fim da falta existente é depois da data_fim da nova falta
                            });
                    })
                    ->where('id', '!=', $editId) // Garantir que não estamos verificando o próprio registro sendo editado
                    ->exists(); // Verifica se existe alguma falta que se sobrepõe

                // Se houver sobreposição, lança uma exceção
                if ($sobreposicao) {
                    $datas = 'A nova falta não pode ser criada, pois as datas se sobrepõem a uma falta existente.';
                    dd($datas);
                    throw new \Exception('A nova falta não pode ser criada, pois as datas se sobrepõem a uma falta existente.');
                }


                // Calcula o número de dias de falta
                $data_inicio = Carbon::parse($data_inicio);
                $data_fim = Carbon::parse($data_fim);
                $dias_falta = $data_inicio->diffInDays($data_fim) + 1; // Adiciona 1 para contar o dia de início também

                $dados['countfaltas'] = $dias_falta;
                // Atualiza as datas junto com os outros campos
                $dadoAeditar->update([
                    'data_inicio' => $data_inicio,
                    'data_fim' => $data_fim,
                    'justificada' => isset($dados['justificada']) ? $dados['justificada'] : $dadoAeditar->justificada,
                    'tipo_falta' => isset($dados['tipo_falta']) ? $dados['tipo_falta'] : $dadoAeditar->tipo_falta,
                    'comentario' => isset($dados['comentario']) ? $dados['comentario'] : $dadoAeditar->comentario,
                    'justificativo_arquivo' => isset($dados['justificativo_arquivo']) ? $dados['justificativo_arquivo'] : $dadoAeditar->justificativo_arquivo,
                    'countfaltas' => $dias_falta, // Atualiza o campo de contagem de faltas


                ]);

                // Calcular a quantidade de dias de falta


            } else {
                // Se as datas não mudaram, atualiza apenas os outros campos
                $dadoAeditar->update([
                    'justificada' => isset($dados['justificada']) ? $dados['justificada'] : $dadoAeditar->justificada,
                    'tipo_falta' => isset($dados['tipo_falta']) ? $dados['tipo_falta'] : $dadoAeditar->tipo_falta,
                    'comentario' => isset($dados['comentario']) ? $dados['comentario'] : $dadoAeditar->comentario,
                    'justificativo_arquivo' => isset($dados['justificativo_arquivo']) ? $dados['justificativo_arquivo'] : $dadoAeditar->justificativo_arquivo,
                ]);
            }

            return $dadoAeditar;
        } catch (\Exception $e) {
            // Lança a exceção com uma mensagem detalhada, dependendo da etapa que falhou
            throw new \Exception('Erro ao editar a falta: ' . $e->getMessage());
        }
    }
    // Método para listar as faltas com base no nome do funcionário
    public function listarFaltasPorNome($nome)
    {
        $query = Falta::with('funcionario');

        // Se o nome for informado, aplica o filtro
        if ($nome) {
            $query->whereHas('funcionario', function ($query) use ($nome) {
                $query->where('nome', 'like', '%' . $nome . '%');
            });
        }
        // Exibe a consulta gerada
     // Mostra a SQL gerada e os resultados obtidos
        // Retorna os resultados da consulta
        return $query->get();
    }


    public function listarFaltasRelatorio(int $id)
    {
        // Supondo que 'Falta' seja o modelo para faltas e que 'funcionario' é o relacionamento correto
    $dados = Falta::with('funcionario') // Carregar as faltas junto com o funcionário associado
    ->where('funcionario_id', $id)->where('aprovacao','Ativado') // Filtrar as faltas pelo id do funcionário
    ->get();
            
            return $dados;
    }
}
