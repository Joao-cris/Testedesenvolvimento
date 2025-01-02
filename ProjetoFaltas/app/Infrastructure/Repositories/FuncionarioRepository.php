<?php
namespace App\Infrastructure\Repositories;

use App\Core\Interfaces\FuncionarioRepositoryInterface;
use App\Infrastructure\Models\Falta;
use App\Infrastructure\Models\Funcionario;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\VarDumper\Server\DumpServer;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class FuncionarioRepository implements FuncionarioRepositoryInterface
{
    public function createFuncionario(array $data): Funcionario
    {
        // Hash da senha antes de salvar
        if (isset($data['senha'])) {
            $data['senha'] = Hash::make($data['senha']);
        }
        return Funcionario::create($data);
    }

    public function listarFuncionario(): Collection
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

    
        return Funcionario::all();
    }

    public function apagar(int $id): bool
    {
        
        $funcionario = Funcionario::find($id);
        return $funcionario ? $funcionario->delete() : false;



    }

    public function updateFuncionario(int $id, array $data): Funcionario
    {
        $funcionario = Funcionario::findOrFail($id);

        $funcionario->update($data);

        return $funcionario;

    }

    public function findFuncionarioById(int $id): Funcionario
    {
        return Funcionario::findOrFail($id);
    }

    public function idfuncioDesconto(int $idfalta, $numerofalta ,int $idfuncionario,$data_inicio, $data_fim):Funcionario
    {

     // Encontra o funcionário pelo ID
    // dd($numerofalta ,$idfuncionario,$data_inicio, $data_fim);
         // Aqui você pode processar os dados recebidos
    // Apenas para depuração

     $employ = Funcionario:: with('faltas')->findOrFail($idfuncionario);
     
    


     
 // Dados da falta (datas de início e fim) já existentes
 $dataInicio = $data_inicio; // Pega a data de início da primeira falta
 $dataFim = $data_fim; // Pega a data de fim da primeira falta
 $id = $idfalta;

 
 // Verifica se já existe uma falta ativada no mesmo intervalo de datas
$existeFaltaAtiva = $employ->faltas()
->where('aprovacao', 'Ativado')
->where('funcionario_id', $idfuncionario) // Verifica pelo ID do funcionário
->where(function($query) use ($dataInicio, $dataFim) {
    $query->whereBetween('data_inicio', [$dataInicio, $dataFim])
          ->orWhereBetween('data_fim', [$dataInicio, $dataFim]);
})
->exists();



if ($existeFaltaAtiva) {
    // Lança a exceção se já existir uma falta ativada nas mesmas datas
   // Retorna para a view com uma mensagem de sucesso ou informação
    return redirect()->route('funcionarios.index') // ou a rota adequada

        ->with('success', 'já existe uma falta com estes dados.'); // Envia a mensagem de sucesso
}
else {
    $aprovacao = 'Nenhuma falta encontrada'; // Caso não haja faltas

 // Verifica se já existe uma falta com aprovação é nas mesmas datas
 $existeFaltaAtiva = $employ->faltas()->where('aprovacao', '')
     ->where('data_inicio', $dataInicio)
     ->where('data_fim', $dataFim)
     ->where('funcionario_id', $idfuncionario) // Verifica pelo ID do funcionário
     ->exists();
      // Agora vamos pegar a falta desejada e marcar como 'Ativado'
        $falta = $employ->faltas()->where('data_inicio', $dataInicio)
            ->where('data_fim', $dataFim)
            ->where('funcionario_id', $idfuncionario) // Verifica pelo ID do funcionário
            ->first();// Pega a falta que corresponde à data de início e fim

        if ($falta) {
            // Atualiza a coluna 'aprovacao' para 'Ativado'
            $falta->aprovacao = 'Ativado'; 
            $falta->save(); // Salva a alteração no banco de dados
        }
        
   // Pega o salário atual do funcionário
   // $salario = $employ->salario;
     // Calcula o novo desconto baseado nas faltas
     $novoDesconto = $numerofalta * 3000;
 
     // Soma o novo desconto ao desconto já aplicado, se houver
     $descontoTotal = $employ->desconto + $novoDesconto;
 
     // Atualiza o campo desconto do funcionário com o valor total de descontos
     $employ->desconto =  $descontoTotal;
 
     $dadosfaltas = Falta::findOrFail($id);

     $dadosfaltas->valordesconto = $novoDesconto;

     $dadosfaltas->save();

    



    // $employ->valordesconto = $novoDesconto;
     // Salva as alterações no banco de dados
     $employ->save();

    
}

 

    // Retorna o objeto Funcionario atualizado
        

        return $employ;
    }

    //TUDO SOBRE LOGIN


    // Processar o login
    public function login(Request $dadoslogin)
{
    $dadoslogin->validate([
        'email' => 'required|email',
        'senha' => 'required|string',
    ]);

    

    // Usando first()
    $funcionario = Funcionario::where('email', $dadoslogin->email)->first();

    // Verifica se o funcionário existe
    if (!$funcionario || !Hash::check($dadoslogin->senha, $funcionario->senha)) {
        return redirect()->route('login.form')->with('error', 'Email ou senha incorretos');
    }





    
    // Usando firstOrFail() para garantir que a consulta não retorne null
    try {
        $funcionario = Funcionario::where('email', $dadoslogin->email)->firstOrFail();
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return redirect()->route('login.form')->with('error', 'Email ou senha incorretos');
    }

    // Gerar o token JWT
    try {
        $token = JWTAuth::fromUser($funcionario);  // Gera o token a partir do funcionário
    } catch (JWTException $e) {
        return response()->json(['error' => 'Não foi possível criar o token'], 500);
    }

// Armazenar o token na sessão
    session(['token' => $token]);  // Armazenando o token na sessã
     // Armazenar o token na sessão (ou cookie) para usá-lo em requisições subsequentes
    
    // Retorna o token para o cliente (ou outras informações, se necessário)
 //   return response()->json(['token' => $token]);

  

    // Autenticação bem-sucedida, redireciona para a página de boas-vindas
    return ( $funcionario);
}

}