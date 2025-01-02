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
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="{{ url('/') }}" class="logo">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="{{ url('/') }}">Início</a></li>
                            <li class="scroll-to-section"><a href="{{ route('funcionarios.faltas') }}">Lista de faltas</a></li>
                            <li class="scroll-to-section"><a href="{{ route('funcionarios.criar') }}">Cadastrar Funcionarios</a></li>
                            @if(Auth::check())
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Sair</button>
                            </form>
                            @else
                            <p>Usuário não autenticado.</p>
                            @endif


                        </ul>

                        <!-- ***** Menu End ***** -->
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
                            <h3>Lista de Funcionários</h3>
                            <p>
                                <a href="{{ route('funcionarios.faltas') }}" class="btn btn-danger">Lista de faltas dos Funcionários</a>
                            </p>
                        </div>
                        </li>
                        </ul>

                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        <div class="table-container">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Imagem</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Cargo</th>
                                        <th>Salário</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($funcionarios as $funcionario)
                                    <tr>
                                        <td>
                                            @if($funcionario->foto)
                                            <img src="{{ asset('storage/' . $funcionario->foto) }}" alt="Foto de {{ $funcionario->nome }}" class="img-thumbnail rounded-circle" style="width: 60px; height: 60px; border: 2px solid blue;">
                                            @else
                                            <p>Sem foto</p>
                                            @endif
                                        </td>
                                        <td>{{ $funcionario->nome }}</td>
                                        <td>{{ $funcionario->email }}</td>
                                        <td>{{ $funcionario->cargo }}</td>
                                        <td>{{ $funcionario->salario }}</td>
                                        <td>
                                            <a href="{{ route('faltas.criar', $funcionario->id) }}" class="btn btn-success">Aplicar falta</a>
                                            <a href="{{ route('funcionarios.edit', $funcionario->id) }}" class="btn btn-warning">Editar</a>
                                            <form action="{{ route('funcionarios.apagar', $funcionario->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Deletar</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Botão para Adicionar Novo Funcionário -->
                            <a href="{{ route('funcionarios.criar') }}" class="btn btn-primary">Adicionar Novo Funcionário</a>
                            <br>
                            <br>
                            <br>
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

                        <br>Desenhado por <a title="CSS Templates" rel="sponsored" href="https://templatemo.com" target="_blank">DesenvolvedoresDeSoftware</a>
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