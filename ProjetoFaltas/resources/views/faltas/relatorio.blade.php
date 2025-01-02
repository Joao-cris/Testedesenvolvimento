<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Funcionários - Faltas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <Style>

        /* Esconde elementos durante a impressão */
@media print {
    .no-print {
        display: none !important;
    }
}
    </Style>
    <div class="container-fluid mt-5">
        <h2 class="text-center text-primary">Relatório de Faltas</h2>

        <!-- Formulário de Pesquisa -->


        <!-- Mensagem de Sucesso -->
        @if(session('success'))
        <div class="alert alert-success mt-4">
            {{ session('success') }}
        </div>
        @endif

        <div class="container mt-5">
    <div class="card">
        <div class="card-body row">
            <!-- Coluna para a Imagem do Funcionário -->
            <div class="col-md-4">
                @if($funcionariosfaltas->first() && $funcionariosfaltas->first()->funcionario && $funcionariosfaltas->first()->funcionario->foto)
                    <p><strong>Imagem do Funcionário:</strong></p>
                    <img src="{{ asset('storage/' . $funcionariosfaltas->first()->funcionario->foto) }}" target="_blank" alt="Imagem do Funcionário" class="img-thumbnail" style="max-width: 100px;">
                @else
                    <p><strong>Imagem:</strong> Não disponível</p>
                @endif
            </div>

            <!-- Coluna para as Informações do Funcionário -->
            <div class="col-md-8">
                <h3>Informações do Funcionário</h3>
                @if($funcionariosfaltas->first() && $funcionariosfaltas->first()->funcionario)
                    <p><strong>Nome:</strong> {{ $funcionariosfaltas->first()->funcionario->nome }}</p>
                    <p><strong>Cargo do funcionário:</strong> {{ $funcionariosfaltas->first()->funcionario->cargo }}</p>
                    <p><strong>Salário:</strong> {{ $funcionariosfaltas->first()->funcionario->salario }}</p>
                @else
                    <p><strong>Informações do Funcionário:</strong> Não encontrado</p>
                @endif

            </div>
        </div>
    </div>
</div>



        <!-- Tabela de Funcionários -->
        <div class="table-responsive mt-4">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr">
                        

                        <th>Justificação</th>
                        <th>Data Início</th>
                        <th>Data Final</th>
                        <th>Tipo de Falta</th>
                   
                        <th>Ver Justificativo</th>
                        <th>contagem de faltas</th>
                        <th>Ativar Falta</th>

                        <th>Desconto de Faltas</th>


                        </tr>
                </thead>
                <tbody>
                    @foreach($funcionariosfaltas as $funcionariosfalta)
                    <tr>
                    {{--   <td>{{ $funcionariosfalta->funcionario ? $funcionariosfalta->funcionario->nome : 'Funcionário não encontrado' }}</td> --}}
                        <td>{{ $funcionariosfalta->justificada }}</td>
                        <td>{{ $funcionariosfalta->data_inicio }}</td>
                        <td>{{ $funcionariosfalta->data_fim }}</td>
                        <td>{{ $funcionariosfalta->tipo_falta }}</td>
                        



                        <td>
                            @if($funcionariosfalta->justificativo_arquivo)
                            <a href="{{ asset('storage/' . $funcionariosfalta->justificativo_arquivo) }}" target="_blank" class="btn btn-info btn-sm">Visualizar Justificativa</a>
                            @else
                            Nenhum arquivo
                            @endif
                        </td>

                        <td class="text-center">
                            @if($funcionariosfalta->aprovacao != 'Ativado')
                            <a href="{{ route('faltas.confirmar', ['id' => $funcionariosfalta -> id,'countfaltas' => $funcionariosfalta->countfaltas, 'funcionario_id' => $funcionariosfalta->funcionario_id,'data_inicio' => $funcionariosfalta->data_inicio,'data_fim' => $funcionariosfalta->data_fim]) }}" class="btn btn-success btn-sm mr-12">
                                <span style="color: #ADD8E6; font-weight: bold; font-size: 18px;">{{ $funcionariosfalta->countfaltas }}</span> Confirmar a falta
                            </a>@else

                            <a>
                                <span style="pointer-events: none; cursor: not-allowed; color: red; font-weight: bold; font-size: 20px;">{{ $funcionariosfalta->countfaltas }}</span> Confirmação feita
                            </a>

                            @endif
                        </td>
                        <td>
                            @if($funcionariosfalta->aprovacao)
                            {{ $funcionariosfalta->aprovacao }}
                            @else
                            <span class="text-danger">Não ativado</span>
                            @endif
                        </td>

                        <td>{{ $funcionariosfalta->valordesconto }}</td>


                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
        <div class="mt-4">
    <h3>Informações de desconto</h3>
    
    @php
        // Inicializa o total de desconto como zero
        $totalDesconto = 0;
    @endphp
    
    <!-- Calcular o total de desconto -->
    @foreach($funcionariosfaltas as $funcionariosfalta)
        @php
            // Verifica se o valor de desconto existe e acumula
            $totalDesconto += $funcionariosfalta->valordesconto;
        @endphp
    @endforeach
    
    <!-- Exibir o total de desconto -->
    <p><strong>Total de Desconto Acumulado:</strong> Kz {{ number_format($totalDesconto, 2, ',', '.') }}</p>
    
    @foreach($funcionariosfaltas as $funcionariosfalta)
        @php
            // Verifica o salário e subtrai o desconto acumulado
            $salarioOriginal = $funcionariosfalta->funcionario ? $funcionariosfalta->funcionario->salario : 0;
            $salarioAjustado = $salarioOriginal - $totalDesconto;
        @endphp
        
       
        
    @endforeach

        <p><strong>Salário Original:</strong> Kz {{ number_format($salarioOriginal, 2, ',', '.') }}</p>
        <p><strong>Salário após Desconto:</strong> Kz {{ number_format($salarioAjustado, 2, ',', '.') }}</p>
</div>




        <!-- Botão para Voltar à Lista de Funcionários -->
        <a class="no-print" href="{{ route('funcionarios.faltas') }}" class="btn btn-success"><p><strong>--Voltar a página anterior--</strong></p></a>
    </div>

    <!-- Scripts do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>