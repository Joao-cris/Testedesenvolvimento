<?php

namespace App\Http\Controllers;

use App\Core\UseCases\FuncionarioUseCase;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class FuncionarioController extends Controller
{
    protected $funcionarioUseCase;

    public function __construct(FuncionarioUseCase $funcionarioUseCase)
    {
        $this->funcionarioUseCase = $funcionarioUseCase;
    }

    public function criar()
    {
        return view('funcionarios.criar');
    }

    public function cadastrarfuncionario(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string',
            'email' => 'required|email|unique:funcionarios,email',
            'senha' => 'required|string',
            'cargo' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validação para foto
            'salario' => 'required|numeric|',

        ]);

        

        // Verifica se a foto foi enviada
        if ($request->hasFile('foto')) {
            // Obtém o nome original da foto
            $fotoNomeOriginal = $request->file('foto')->getClientOriginalName();

            // Armazena a foto na pasta 'public/fotos' e gera o caminho
            $fotoPath = $request->file('foto')->storeAs('fotos', $fotoNomeOriginal, 'public');

            // Adiciona o caminho da foto ao array de dados
            $data['foto'] = 'fotos/' . $fotoNomeOriginal;
        }




        $dadosrecebido  =   $this->funcionarioUseCase->createFuncionario($data);

        return redirect()->route('funcionarios.index')->with('success', 'Funcionário cadastrado com sucesso!');
    }

    public function index()
    {
        
        $funcionarios = $this->funcionarioUseCase->listarFuncionario();
        return view('funcionarios.index', compact('funcionarios'));
    }

    public function apagar($id)
    {
        $deleted = $this->funcionarioUseCase->apagar($id);

        if ($deleted) {
            return redirect()->route('funcionarios.index')->with('success', 'Funcionário deletado com sucesso!');
        }

        return redirect()->route('funcionarios.index')->with('error', 'Funcionário não encontrado ou erro ao deletar!');
    }

    public function edit($id)
    {
        $funcionario = $this->funcionarioUseCase->findFuncionarioById($id);
        return view('funcionarios.edit', compact('funcionario'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([

            'nome' => 'required|string',
            'email' => 'required|email|unique:funcionarios,email,' . $id,
            'senha' => 'required|string',
            'cargo' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'salario' => 'required|numeric|',// Validação para foto


        ]);
        // Verifica se a foto foi enviada
        if ($request->hasFile('foto')) {
            // Obtém o nome original da foto
            $fotoNomeOriginal = $request->file('foto')->getClientOriginalName();

            // Armazena a foto na pasta 'public/fotos' e gera o caminho
            $fotoPath = $request->file('foto')->storeAs('fotos', $fotoNomeOriginal, 'public');

            // Adiciona o caminho da foto ao array de dados
            $data['foto'] = 'fotos/' . $fotoNomeOriginal;
        }


        $this->funcionarioUseCase->updateFuncionario($id, $data);

        return redirect()->route('funcionarios.index')->with('success', 'Funcionário atualizado com sucesso!');
    }

    public function confirmar($idfalta, $contFalta, $idfuncionario, $data_inicio, $data_fim)
    {
           //  dd($contFalta, $idfuncionario,$data_inicio,$data_fim);
           // Passando os dados para a sessão e redirecionando para a lista de funcionários
       $ContFaltas =  $this->funcionarioUseCase->IdFuncioDesconto($idfalta , $contFalta,$idfuncionario,$data_inicio,$data_fim);


       
        
        return redirect()->route('funcionarios.index')->with(compact('ContFaltas', 'idfuncionario'));
    }


    //tudo sobre login
    // Exibir a view de login

    public function showLoginForm()
    {
        return view('login.login');
    }

    public function chamarlogin(Request $dados)
    {

        $dadoslogin = $this->funcionarioUseCase->loginCase($dados);

        // Recebe o token do header Authorization
 
    

       // return view('funcionarios.boasvindas',compact('dadoslogin'));

   
    // Ou use $dados->input('token') caso envie via corpo
    $token = session('token');  // Supondo que você armazenou o token na sessão
    // Armazenar o token e a data de expiração na sessão
    

 
 try {
    // Define o token para o JWT e autentica o usuário
    $user = JWTAuth::setToken($token)->authenticate();
    
    

    // Verifica se o usuário foi encontrado
    if (!$user) {
        return response()->json(['error' => 'Usuário não autenticado'], 401);
    }

    // Extrair as claims do token
 $claims = JWTAuth::getPayload($token); // Extrai as claims associadas ao token

 

 // Exemplo de como acessar claims específicas
 $nome = $claims->get('nome'); // Aqui estamos acessando a claim 'nome'
 $cargo = $claims->get('cargo'); // Acessando a claim 'cargo'
 $email = $claims->get('email'); // Acessando a claim 'email'

 // Retorna os dados da view ou response com as claims
  // Passa os dados para a view se estiverem válidos
  
  return redirect()->route('funcionarios.boasvindas', compact('nome', 'cargo', 'email'));

 //   dd( $user);
    
} catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
    // Se ocorrer um erro com o token, exibe a mensagem de erro
     return redirect()->route('login.form')->with('error', 'Email ou senha incorretos');
}

    // Retorna a view de boas-vindas com os dados do usuário autenticado
  //  return view('funcionarios.boasvindas', ['user' => $user]);


    }
// sair da sessao

    public function logout()
{
    session()->flush();
    
    // Remove o token da sessão
    session()->forget('token');
    // Desloga o usuário
  //  Auth::logout();

    // Limpa a sessão
    
    // Opcional: Se você quiser destruir toda a sessão
    // session()->flush();

    // Redireciona o usuário de volta para a página de login
    return redirect('/');

    
}

public function boasVindas(Request $request)
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
        return view('funcionarios.boasvindas', compact('nome', 'cargo', 'email'));

    } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
        return redirect()->route('login.form')->with('error', 'Token inválido ou expirado.');
    }
}

}
