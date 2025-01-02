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
                        <!-- Mensagem de Sucesso -->
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        <!-- Verifica se as claims estão presentes e não vazias -->
                        @if(isset($nome) && isset($cargo) && isset($email) && $nome && $cargo && $email)
                        <h1>Bem-vindo, {{ $nome }}!</h1>
                        <p>Cargo: {{ $cargo }}</p>
                        <p>Email: {{ $email }}</p>

                        <!-- Verifica se o email é igual ao valor desejado -->


                        @else
                        <p>Usuário não autenticado ou informações incompletas.</p>
                        @endif

                        <br>



                        <!-- Seção fixa ao rolar -->
                        <div class="sticky-section">
                            <form action="{{ route('funcionarios.faltas.pesquisar') }}" method="GET" class="mb-4">
                                <div class="form-row d-flex align-items-center"> <!-- Usando d-flex para flexbox -->
                                    <div class="col-md-6"> <!-- Ajuste para o título e o botão -->
                                        <h3>Lista de Funcionários com faltas ativos/não ativos</h3>
                                        <p>
                                            <a href="#" class="btn btn-danger">Pesquisa no campo se há uma falta 👉</a>
                                        </p>
                                    </div>
                                    <div class="col-md-4 pr-1"> <!-- Ajuste para o campo de pesquisa -->
                                        <input type="text" class="form-control" name="nome" placeholder="Pesquisar por nome"
                                            value="{{ isset($nome) ? $nome : '' }}" readonly>
                                    </div>

                                    <div class="col-md-4 pr-1"> <!-- Ajuste para o botão de pesquisa -->
                                        <button type="submit" class="btn btn-primary btn-block">Pesquisar faltas</button>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <br>
                        <br>
                        <form action="" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="comentario">Deixe seu comentário:</label>
                                <textarea name="comentario" id="comentario" class="form-control" style="height: 100px; width: 600px;" placeholder="Escreva seu comentário aqui..."></textarea>
                            </div>
                            <br>
                           
                            <a href="#" class="btn btn-primary">Enviar Comentário</a>
                        </form>
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