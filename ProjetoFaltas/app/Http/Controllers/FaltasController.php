<?php

namespace App\Http\Controllers;

use App\Core\Entities\Falta;
use Barryvdh\DomPDF\Facade as PDF;
use App\Core\UseCases\FaltasUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;

class  FaltasController  extends Controller
{
    protected $faltasUseCase;

    // Injeção de dependência do UseCase
    public function __construct(FaltasUseCase $faltasUseCase)
    {
        $this->faltasUseCase = $faltasUseCase;
    }


    // Exibe o formulário para criar uma nova falta
    public function criar($funcionarioId)
    {
        return view('faltas.criar', compact('funcionarioId')); // Retorna a view 'faltas/criar.blade.php' com o ID do funcionário
    }

    public function store(Request $request, $funcionarioId)
    {
        $data = $request->validate([
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
            'tipo_falta' => 'required|string',
            'justificada' => 'required|string',
            'comentario' => 'nullable|string|max:255',
            'justificativo_arquivo' => 'nullable|file|mimes:jpg,png,pdf,docx|max:2048',
        ]);

        $data['funcionario_id'] = $funcionarioId;

        // Calcular a quantidade de dias de falta
        $data_inicio = Carbon::parse($data['data_inicio']);
        $data_fim = Carbon::parse($data['data_fim']);
        $dias_falta = $data_inicio->diffInDays($data_fim) + 1; // Adiciona 1 para contar o dia de início também

        

        $data['countfaltas'] = $dias_falta;


        // Verifica se a foto foi enviada
        if ($request->hasFile('justificativo_arquivo')) {
            // Obtém o nome original da foto
            $fotoNomeOriginal = $request->file('justificativo_arquivo')->getClientOriginalName();

            // Armazena a foto na pasta 'public/fotos' e gera o caminho
            $fotoPath = $request->file('justificativo_arquivo')->storeAs('justificativo', $fotoNomeOriginal, 'public');

            // Adiciona o caminho da foto ao array de dados
            $data['justificativo_arquivo'] = 'justificativo/' . $fotoNomeOriginal;
        }

        $this->faltasUseCase->registrarFalta($data);

        return redirect()->route('funcionarios.index')->with('success', 'Falta registrada com sucesso!');
    }

    public function remover($id)
    {
        $this->faltasUseCase->deleteFalta($id);

        return redirect()->route('funcionarios.faltas')->with('success', 'Falta deletada com sucesso!');
    }

    // chamar o caseuse para ver faltas
    public function FuncionarioFaltas()

    {

        $funcionariosfaltas =  $this->faltasUseCase->getFaltasByFuncionarios();


        return view('faltas.verfaltas', compact('funcionariosfaltas'));
    }

    public function funcionariofalta($id)
    {

        $dados = $this->faltasUseCase->getFaltaById($id);

        // Retorna a view de edição com os dados de  faltas de um dado funcionario no  formulario

        return view('faltas.edit', compact('dados'));
    }


    // Processa a atualização do funcionário
    public function actualizar(Request $request, $id)
    {
        // Validação dos dados recebidos do formulário
        $data = $request->validate([
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date',
            'tipo_falta' => 'required|string',
            'justificada' => 'required|string',
            'comentario' => 'nullable|string|max:255',
            'justificativo_arquivo' => 'nullable|file|mimes:jpg,png,pdf,docx|max:2048',  // Validação do arquivo


        ]);

        // Calcular a quantidade de dias de falta
        $data_inicio = Carbon::parse($data['data_inicio']);
        $data_fim = Carbon::parse($data['data_fim']);
        $dias_falta = $data_inicio->diffInDays($data_fim) + 1; // Adiciona 1 para contar o dia de início também

        $data['countfaltas'] = $dias_falta;

        // Verifica se o arquivo de justificativa foi enviado
        if ($request->hasFile('justificativo_arquivo')) {
            // Obtém o nome original do arquivo
            $nomeOriginal = $request->file('justificativo_arquivo')->getClientOriginalName();

            // Armazena o arquivo na pasta 'justificativo' com o nome original
            $justificativoArquivo = $request->file('justificativo_arquivo')->storeAs('justificativo', $nomeOriginal, 'public');

            // Adiciona o caminho do arquivo no array de dados
            $data['justificativo_arquivo'] = 'justificativo/' . $nomeOriginal;
        }

        // Chama o método de atualização do repositório
        $funcionario = $this->faltasUseCase->editarFalta($id, $data);

        // Redireciona para a página de listagem com mensagem de sucesso
        return redirect()->route('funcionarios.faltas')->with('success', 'Funcionário com falta atualizado com sucesso!');
    }
//pesquisar o funcionario com falta activado



// Método para listar as faltas e aplicar a pesquisa
public function listarFaltas(Request $request)
{
    // Recupera o nome da pesquisa
    $nomePesquisa = $request->input('nome');
    
    // Chama o repositório para obter os dados filtrados
    $funcionariosfaltas = $this->faltasUseCase->execute($nomePesquisa);
    $token = session('token');  // Supondo que você armazenou o token na sessão

    if (!$token) {
        return redirect()->route('login.form')->with('error', 'Você precisa estar autenticado para acessar esta página.');
    }

    try {
        // Define o token para o JWT e autentica o usuário
        $user = JWTAuth::setToken($token)->authenticate();

        // Verifica se o usuário foi encontrado
        if (!$user) {
            return redirect()->route('login.form')->with('error', 'Usuário não autenticado.');
        }

        // Extrair as claims do token
        $claims = JWTAuth::getPayload($token); // Extrai as claims associadas ao token

        // Acessa as claims
        $nome = $claims->get('nome');
        $cargo = $claims->get('cargo');
        $email = $claims->get('email');

   

} catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
    return redirect()->route('login.form')->with('error', 'Token inválido ou expirado.');
}

 


    
    // Retorna a view com os dados
    return view('faltas.faltapesquisa', compact('funcionariosfaltas','nome', 'cargo', 'email'));
}
// Método para listar as faltas e aplicar a pesquisa
public function relatoriofaltas($id)
{
  
    $funcionariosfaltas =  $this->faltasUseCase->listarFaltasRelatories($id);   

    

return view('faltas.relatorio', compact('funcionariosfaltas'));  
}
 public function usuario()

 {
       // Verifica se o token está presente na sessão
    $token = session('token');  // Supondo que você armazenou o token na sessão

    if (!$token) {
        return redirect()->route('login.form')->with('error', 'Você precisa estar autenticado para acessar esta página.');
    }

    try {
        // Define o token para o JWT e autentica o usuário
        $user = JWTAuth::setToken($token)->authenticate();

        // Verifica se o usuário foi encontrado
        if (!$user) {
            return redirect()->route('login.form')->with('error', 'Usuário não autenticado.');
        }

        // Extrair as claims do token
        $claims = JWTAuth::getPayload($token); // Extrai as claims associadas ao token

        // Acessa as claims
        $nome = $claims->get('nome');
        $cargo = $claims->get('cargo');
        $email = $claims->get('email');

        // Passa os dados para a view
        return view('faltas.usuario', compact('nome', 'cargo', 'email'));

    } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
        return redirect()->route('login.form')->with('error', 'Token inválido ou expirado.');
    }


 }

    
}
