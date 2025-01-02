{{-- resources/views/funcionarios/errors.blade.php --}}

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro - Funcionário</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Exemplo de link para o CSS -->
</head>
<body>
    <div style="max-width: 600px; margin: 50px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
        <h2 style="color: #b92e2e;">Ocorreu um erro!</h2>
        <p style="font-size: 18px; color: #333;">
            <strong>Mensagem:</strong> {{ $message }}
        </p>

        <p style="font-size: 16px; color: #555;">
            Por favor, tente novamente mais tarde. Se o erro persistir, entre em contato com o suporte.
        </p>

        <a href="{{ url()->previous() }}" style="color: #007bff; text-decoration: none;">Voltar para a página anterior</a>
    </div>
</body>
</html>
