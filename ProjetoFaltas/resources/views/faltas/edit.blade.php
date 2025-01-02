<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Funcionário Com Falta</title>
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
                <h2>Editar Funcionário Com Falta</h2>
            </div>
            <div class="card-body">
                <!-- Se houver mensagem de erro ou sucesso, será exibido aqui -->
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                

                <form action="{{ route('faltas.update', $dados->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Define o método como PUT para atualização -->

                    <div class="form-group">
                        <label for="data_inicio">Data de Inicio de falta:</label>
                        <input type="date" name="data_inicio" class="form-control" value="{{ old('data_inicio', $dados->data_inicio) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="data-fim">Data de fim de falta:</label>
                        <input type="date" name="data_fim" class="form-control" value="{{ old('data_fim', $dados->data_fim) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="tipo_falta">Tipo de falta:</label>
                        <select name="tipo_falta" class="form-control" required>
                            <optgroup label="Faltas Justificadas">
                                <option value="Doença">Doença</option>
                                <option value="Acidente de Trabalho">Acidente de Trabalho</option>
                                <option value="Licença Maternidade/Paternidade">Licença Maternidade/Paternidade</option>
                                <option value="Licença Médica">Licença Médica</option>
                                <option value="Férias">Férias</option>
                                <option value="Falecimento de Parente Próximo">Falecimento de Parente Próximo</option>
                                <option value="Casamento">Casamento</option>
                                <option value="Motivos de Força Maior">Motivos de Força Maior</option>

                            </optgroup>

                            <!-- Faltas Não Justificadas -->
                            <optgroup label="Faltas Não Justificadas">
                                <option value="Ausência Sem Justificativa">Ausência Sem Justificativa</option>
                                <option value="Atraso">Atraso</option>
                                <option value="Saída Antecipada">Saída Antecipada</option>
                                <option value="Deserção de Função">Deserção de Função</option>
                            </optgroup>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="justificada">Justificada:</label>
                        <select name="justificada" class="form-control" required>
                            <option value="Justificada">Justificada</option>
                            <option value="Não Justificada">Não Justificada</option>
                        </select>
                    </div>
                      
                    <!-- Campo para Upload de Arquivo -->
                    <div class="form-group mb-3">
                        <label for="justificativo_arquivo">Arquivo de Justificativa:</label>
                        <input type="file" name="justificativo_arquivo" class="form-control">
                    </div>
                    
                    <!-- Campo de Comentário -->
                    <div class="form-group mb-3">
                        <label for="comentario">Comentário:</label>
                        <textarea name="comentario" class="form-control" rows="4"></textarea>
                    </div>


                    <button type="submit" class="btn btn-success w-100">Editar Funcionário com Falta</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Adicionando os Scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>