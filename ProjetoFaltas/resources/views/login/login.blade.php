<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <title>Login</title>
    
    <!-- Link do Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- Link do Bootstrap CSS para os botões -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Link para o Font Awesome (garantir que os ícones aparecerão) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Estilos personalizados -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            height: 100vh;
            background-image: url('/assets/image/programador1.png'); /* Caminho relativo */
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.8); /* Fundo branco com opacidade */
            padding: 40px 60px;
            border-radius: 12px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
            width: 600px;
            text-align: center;
        }

        h2 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
            font-weight: 500;
        }

        label {
            font-size: 14px;
            color: #555;
            margin-bottom: 8px;
            display: block;
            text-align: left;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #4CAF50;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
        
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        h2 i {
            margin-right: 10px; /* Espaço entre o ícone e o texto */
            color: #4CAF50;
            font-size: 1.5rem;
        }

        button:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }

        .error-message ul {
            list-style-type: none;
        }

        .error-message ul li {
            margin: 5px 0;
        }

        .footer-text {
            margin-top: 20px;
            color: #777;
            font-size: 14px;
        }

        .footer-text a {
            color: #4CAF50;
            text-decoration: none;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }

        /* Adicionando efeito de animação de entrada */
        .login-container {
            animation: fadeIn 0.8s ease-in-out;
       
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        /* Estilo para os botões sociais */
        .social-buttons {
            margin-top: 10px;
             margin-right: 12px;
            align-items: center;

   
            
        
           
        }

        .social-buttons a {
            display: block;
            width: 100%;
            padding: 12px;
            margin: 14px ;
    
            border-radius: 8px;
            text-align: center;
            font-size: 16px;
            color: white;
            font-weight: bold;
            transition: background-color 0.3s;
            text-decoration: none;
       
            margin-left: 5px;
      
        
        }

        .google-btn {
            background-color: #db4437;
  
        }

        .google-btn:hover {
            background-color: #c1351d;
        }

        .facebook-btn {
            background-color: #3b5998;
        }

        .facebook-btn:hover {
            background-color: #2d4373;
        }

        .github-btn {
            background-color: #333;
            
        }

        .github-btn:hover {
            background-color: #444;
        }

        /* Ícones nos botões sociais */
        .social-buttons i {
            margin-right: 30px;
        }
    </style>
</head>
<body>

    <div class="login-container">
    <h2><i class="fas fa-user-lock"></i>Login</h2>

        <!-- Formulário de Login -->
        <form action="{{ route('chamarlogin') }}" method="POST">
            @csrf
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required>

            <button type="submit">Entrar</button>
        </form>

        <!-- Exibir mensagens de erro -->
        @if(session('error'))
            <p class="error-message">{{ session('error') }}</p>
        @endif

        <!-- Exibir erros de validação -->
        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Botões sociais de login -->
        <div class="social-buttons">
            <a href="#" class="google-btn">
                <i class="fab fa-google"></i> Google
            </a>
            <a href="#" class="facebook-btn">
                <i class="fab fa-facebook-f"></i> Facebook
            </a>
            <a href="#" class="github-btn">
                <i class="fab fa-github"></i> GitHub
            </a>
        </div>

        <!-- Footer com link de recuperação de senha -->
        <div class="footer-text">
            <p><a href="">Esqueceu a senha?</a></p>
        </div>
    </div>

    <!-- Scripts para o Font Awesome, Bootstrap e interatividade -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts para interatividade -->
    <script>
        // Adiciona uma animação de foco ao input do email
        const emailInput = document.getElementById('email');
        emailInput.addEventListener('focus', function() {
            emailInput.style.borderColor = '#4CAF50';
        });

        emailInput.addEventListener('blur', function() {
            emailInput.style.borderColor = '#ddd';
        });

        // Adiciona animação de foco ao input de senha
        const senhaInput = document.getElementById('senha');
        senhaInput.addEventListener('focus', function() {
            senhaInput.style.borderColor = '#4CAF50';
        });

        senhaInput.addEventListener('blur', function() {
            senhaInput.style.borderColor = '#ddd';
        });
    </script>

</body>
</html>
