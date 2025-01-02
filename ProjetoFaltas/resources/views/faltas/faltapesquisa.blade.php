<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Funcionários - Faltas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid mt-5">
        <h2 class="text-center text-primary">Lista de Funcionários - Faltas</h2>

        <!-- Exibe as faltas -->
        <div class="table-responsive mt-4">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Justificação</th>
                        <th>Data Início</th>
                        <th>Data Final</th>
                        <th>Tipo de Falta</th>
                        <th>Contagem de Faltas</th>
                        <th>Aprovação</th>
                        <th>Salario vencimento</th>
                        <th>Descontos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($funcionariosfaltas as $funcionariosfalta)
                    <tr>
                        <!-- Exibe nome do funcionário -->
                        <td>{{ $funcionariosfalta->funcionario->nome ?? 'Funcionário não encontrado' }}</td>

                        <!-- Exibe a justificação -->
                        <td>{{ $funcionariosfalta->justificada }}</td>

                        <!-- Exibe data de início -->
                        <td>{{ $funcionariosfalta->data_inicio }}</td>

                        <!-- Exibe data final -->
                        <td>{{ $funcionariosfalta->data_fim }}</td>

                        <!-- Exibe tipo de falta -->
                        <td>{{ $funcionariosfalta->tipo_falta }}</td>

                        <!-- Exibe a contagem de faltas -->
                        
                        <td>{{ $funcionariosfalta->countfaltas }}</td>
                        <!-- Exibe o status da aprovação -->
                        <td>
                            @if($funcionariosfalta->aprovacao)
                                {{ $funcionariosfalta->aprovacao }}
                            @else
                                <span class="text-danger">Não ativado</span>
                            @endif
                        </td>
                       


                        <td style="color: blue; font-size:18px;">{{ $funcionariosfalta->funcionario->salario}} </td>

                       <!-- Exibe nome do funcionário -->
                      
                       <td style="color: red; font-size:18px;">{{ $funcionariosfalta->valordesconto }}</td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
  <!-- Verifica se as claims estão presentes e não vazias -->
  @if(isset($nome) && isset($cargo) && isset($email) && $nome && $cargo && $email)

    <h3>nome: {{ $nome }}!</h3>
  


    
    
    
    <!-- Verifica se o email é igual ao valor desejado -->
    @if($email == 'carlosantos@hotmail.com')
        <a href="{{ route('funcionarios.index') }}" class="btn btn-primary">Começando com as suas actividades</a>
    @else
        <a href="{{ route('faltas.usuario') }}" class="btn btn-primary">Voltar</a>
    @endif

@else
    <p>Usuário não autenticado ou informações incompletas.</p>
@endif
        <!-- Botão para Voltar -->
       
    </div>

    <!-- Scripts do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
