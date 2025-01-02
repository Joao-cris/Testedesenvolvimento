<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Mexant HTML5 Template - About page</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-574-mexant.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">

    <!-- Custom CSS -->
    <style>
        .sticky-section {
            position: sticky;
            top: 80px;
            /* Distância do topo para onde deve ficar fixo */
            background-color: #fff;
            z-index: 1000;
            padding: 15px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .sticky-section .btn {
            margin: 5px;
        }

        /* Garantindo que a tabela tenha um pouco de espaçamento acima */
        .table-container {
            padding-top: 20px;
        }

        /* Adicionando padding-top para o conteúdo seguinte, para compensar a altura da seção fixa */
        .content-section {
            padding-top: 100px;
            /* Ajuste conforme a altura da seção fixa */
        }
    </style>
</head>

<body>

    <!-- ***** Header Area Start ***** -->
    <!-- ***** Header Area Start ***** -->
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <a href="{{ url('/') }}" class="logo">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="">
                        </a>
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="{{ url('/') }}">Início</a></li>
                            <li class="scroll-to-section"><a href="{{ route('funcionarios.index') }}">Lista de funcionarios</a></li>

                            @if(Auth::check())
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Sair</button>
                            </form>
                            @else
                            <p>Usuário não autenticado.</p>
                            @endif


                        </ul>

                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Content Start ***** -->
    <section class="content-section">

        <div class="container">

            <div class="row">
                <div class="col-lg-12 align-self-center">
                    <div class="accordions is-first-expanded">
                        <!-- Tabela de Funcionários -->


                        <!-- Seção fixa ao rolar -->
                        <div class="sticky-section">
                            <form action="{{ route('funcionarios.faltas.pesquisar') }}" method="GET" class="mb-4">
                                <div class="form-row d-flex align-items-center"> <!-- Usando d-flex para flexbox -->
                                    <div class="col-md-6"> <!-- Ajuste para o título e o botão -->
                                        <h3>Lista de Funcionários com faltas ativos/não ativos</h3>
                                        <p>
                                            <a href="{{ route('funcionarios.index') }}" class="btn btn-danger">Lista dos Funcionários</a>
                                        </p>
                                    </div>
                                    <div class="col-md-4 pr-1"> <!-- Ajuste para o campo de pesquisa -->
                                        <input type="text" class="form-control" name="nome" placeholder="Pesquisar por nome" value="{{ request()->input('nome') }}">
                                    </div>
                                    <div class="col-md-4 pr-1"> <!-- Ajuste para o botão de pesquisa -->
                                        <button type="submit" class="btn btn-primary btn-block">Pesquisar</button>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <!-- Mensagem de Sucesso -->
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        <div class="table-container">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr">
                                        <th>Nome</th>

                                        <th>Justificação</th>
                                        <th>Data Início</th>
                                        <th>Data Final</th>
                                        <th>Tipo de Falta</th>
                                        <th>Ver Justificativo</th>
                                        <th>contagem de faltas</th>
                                        <th>Ativar Falta</th>

                                        <th>Desconto de Faltas</th>
                                        <th>Ações</th>

                                        </tr>
                                </thead>
                                <tbody>
                                    @foreach($funcionariosfaltas as $funcionariosfalta)
                                    <tr>
                                        <td>{{ $funcionariosfalta->funcionario ? $funcionariosfalta->funcionario->nome : 'Funcionário não encontrado' }}</td>
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

                                        <td class="text-center">
                                            <!-- Botões de Ação -->
                                            <div class="btn-group" role="group" aria-label="Ações">

                                                <!--    Botão "relatorio" -->

                                                @if($funcionariosfalta->aprovacao != 'Ativado')
                                                <span class="btn btn-dark btn-sm mr-2" style="pointer-events: none; cursor: not-allowed;">Criar relatorio</span>
                                                @else

                                                <a href="{{ route('faltas.relatorio', $funcionariosfalta->funcionario_id) }}" class="btn btn-dark btn-sm mr-2">Criar relatorio</a>
                                                @endif






                                                <a href="{{ route('faltas.apagar', $funcionariosfalta->id) }}" class="btn btn-danger btn-sm mr-2">Deletar</a>


                                                @if($funcionariosfalta->aprovacao != 'Ativado')
                                                <a href="{{ route('faltas.edit', $funcionariosfalta->id) }}" class="btn btn-warning btn-sm mr-2">Editar</a>
                                                @else
                                                <span class="btn btn-warning btn-sm mr-2" style="pointer-events: none; cursor: not-allowed;">Editar</span>
                                                @endif

                                                <!--   Botão "Editar" -->

                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            <!-- Botão para Adicionar Novo Funcionário -->
                            <a href="{{ route('funcionarios.index') }}" class="btn btn-primary">Voltar a lista de Funcionário</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="simple-cta">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <h4>Negocios e <em>Soluções</em>, <strong>Desnvolvimento</strong> de software</h4>
                </div>
                <div class="col-lg-7">
                    <div class="buttons">
                        <div class="green-button">
                            <a href="#">Listagem de faltas</a>
                        </div>
                        <div class="orange-button">
                            <a href="#">Procurar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright © 2024/2025 Desenvolvedores de software., Ltd. todo directo reservado.

                        <br>Desenhado por <a title="CSS Templates" rel="sponsored" href="https://templatemo.com" target="_blank">DesenvolvidoresDeSoftware</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>



    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('assets/js/tabs.js') }}"></script>
    <script src="{{ asset('assets/js/swiper.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

</body>

</html>