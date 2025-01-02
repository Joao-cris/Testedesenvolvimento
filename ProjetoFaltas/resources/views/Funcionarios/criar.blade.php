<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Funcionário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-574-mexant.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
    <style>
        .sticky-section {
            position: sticky;
            top: 80px;
            background-color: #fff;
            z-index: 1000;
            padding: 15px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .sticky-section .btn {
            margin: 5px;
        }

        .content-section {
            padding-top: 100px;
        }

        .form-container {
            margin-top: 30px;
        }

        .form-container input,
        .form-container select,
        .form-container textarea {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-container label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-container .btn {
            margin-top: 10px;
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
                      <a href="{{ url('/') }}" class="logo">
                          <img src="{{ asset('assets/images/logo.png') }}" alt="">
                      </a>
                      <ul class="nav">
                          <li class="scroll-to-section"><a href="{{ url('/') }}">Home</a></li>
                          <li class="scroll-to-section"><a href="{{ url('/') }}">Services</a></li>
                          <li class="scroll-to-section"><a href="{{ url('/') }}">About</a></li>
                          <li class="has-sub">
                              <a href="javascript:void(0)">Pages</a>
                              <ul class="sub-menu">
                                  <li><a href="{{ url('/about-us') }}">About Us</a></li>
                                  <li><a href="{{ url('/our-services') }}">Our Services</a></li>
                                  <li><a href="{{ url('/contact-us') }}">Contact Us</a></li>
                              </ul>
                          </li>
                          <li class="scroll-to-section"><a href="{{ url('/') }}">Testimonials</a></li>
                          <li><a href="{{ url('/contact-us') }}">Contact Support</a></li> 
                      </ul>
                      <a class='menu-trigger'>
                          <span>Menu</span>
                      </a>
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

                    <!-- Seção fixa ao rolar -->
                    <div class="sticky-section">
                        <h3>Cadastrar Novo Funcionário</h3>
                    </div>

                    <!-- Exibe erros de validação, se houver -->
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Formulário de criação -->
                    <div class="form-container">
                        <form action="{{ route('funcionarios.cadastrarfuncio') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Campo para o nome -->
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" required>
                            </div>

                            <!-- Campo para o email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            </div>

                            <!-- Campo para a senha -->
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="text" class="form-control" id="senha" name="senha" value="{{ old('senha') }}" required>
                            </div>

                            <!-- Campo para o cargo -->
                            <div class="mb-3">
                                <label for="cargo" class="form-label">Cargo</label>
                                <input type="text" class="form-control" id="cargo" name="cargo" required>
                            </div>

                            <!-- Campo para o salário -->
                            <div class="mb-3">
                                <label for="salario" class="form-label">Determinar/Salário</label>
                                <input type="number" class="form-control" id="salario" name="salario" step="0.01" required>
                            </div>

                            <!-- Campo para Upload de Arquivo -->
                            <div class="form-group mb-3">
                                <label for="foto">Adicionar Foto:</label>
                                <input type="file" name="foto" class="form-control">
                            </div>

                            <!-- Botão de enviar -->
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </form>
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
          <p>Copyright © 2022 Mexant Co., Ltd. All Rights Reserved. 
          <br>Designed by <a title="CSS Templates" rel="sponsored" href="https://templatemo.com" target="_blank">TemplateMo</a></p>
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
