<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Funcionário</title>
    <!-- Adicionando o Bootstrap para facilitar a estilização -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .card {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background: linear-gradient(45deg, #6f42c1, #007bff);
            color: #fff;
            text-align: center;
            font-size: 1.5rem;
            padding: 15px 0;
            border-radius: 10px 10px 0 0;
        }
        .form-control {
            border-radius: 10px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.25rem rgba(38, 143, 255, 0.25);
        }
        button[type="submit"] {
            background: linear-gradient(45deg, #6f42c1, #007bff);
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        button[type="submit"]:hover {
            background: linear-gradient(45deg, #007bff, #6f42c1);
        }
        label {
            font-size: 1rem;
            font-weight: bold;
        }
        .alert {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Editar Funcionário</h2>
        </div>
        <div class="card-body">
            <!-- Se houver mensagem de erro ou sucesso, será exibido aqui -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('funcionarios.update', $funcionario->id) }}" method="POST"enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Define o método como PUT para atualização -->

                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" class="form-control" value="{{ old('nome', $funcionario->nome) }}" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $funcionario->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="cargo">Cargo:</label>
                    <input type="text" name="cargo" class="form-control" value="{{ old('cargo', $funcionario->cargo) }}" required>
                </div>
                <div class="form-group">
                    <label for="salario">Salario:</label>
                    <input type="numeric" name="salario" class="form-control" value="{{ old('salrio', $funcionario->salario) }}" required>
                </div>
                <!-- Campo para Upload de Arquivo -->
                <div class="form-group mb-3">
                        <label for="foto">Adicionar Foto:</label>
                        <input type="file" name="foto" class="form-control" required>
                    </div>

                <button type="submit" class="btn btn-success w-100">Atualizar Funcionário</button>
            </form>
        </div>
    </div>
</div>

<!-- Adicionando os Scripts do Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
