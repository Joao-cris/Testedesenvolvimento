<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Boas Vindas')</title>
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-574-mexant.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
    <style>
        .page-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #4CAF50;
            text-align: center;
            padding: 30px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .page-title span {
            color: #FF5722;
            font-style: italic;
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
                          <li class="scroll-to-section"><a href="{{ url('/') }}">Início</a></li>
                         
                          <li>    <!-- Verifica se o usuário está autenticado -->
                @if(Auth::check())
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Sair</button>
                    </form>
                @else
                    <p>Usuário não autenticado.</p>
                @endif</li> 
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

                <!-- Título Elegante para a Página -->
                <div class="page-title">
                    <p><span>--- </span>Página de <span>BOAS VINDAS</span> ---</p>
                </div>

               <!-- Verifica se as claims estão presentes e não vazias -->
@if(isset($nome) && isset($cargo) && isset($email) && $nome && $cargo && $email)
@if($email == 'carlosantos@hotmail.com')

<h1>Bem-vindo! Sr,(a) Administrador {{ $nome }}!</h1>

@else

<h1>Bem-vindo! Carissimo, {{ $nome }}!</h1>

@endif
   
    
    <p>Email: {{ $email }}</p>
    <p>Cargo: {{ $cargo }}</p>
    
    <!-- Verifica se o email é igual ao valor desejado -->
    @if($email == 'carlosantos@hotmail.com')
        <a href="{{ route('funcionarios.index') }}" class="btn btn-primary">Começando com as suas actividades</a>
    @else
        <a href="{{ route('faltas.usuario') }}" class="btn btn-primary">Começando com as suas actividades</a>
    @endif

@else
    <p>Usuário não autenticado ou informações incompletas.</p>
@endif
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
          
          <br>Desenhado por <a title="CSS Templates" rel="sponsored" href="https://templatemo.com" target="_blank">DesenvolvedoresDeSoftware</a></p>
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
