<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Falta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilo adicional para centralizar o formulário na tela */
        body {
            background-color: #f7f7f7;
            padding-top: 50px;
        }

        .container {
            max-width: 700px;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #28a745;
            color: white;
            text-align: center;
            font-size: 1.5rem;
            border-radius: 15px 15px 0 0;
            padding: 15px;
        }

        .card-body {
            padding: 30px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group select,
        .form-group input,
        .form-group textarea {
            border-radius: 10px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #28a745;
        }

        .btn {
            width: 100%;
            border-radius: 10px;
        }

        .form-control,
        .btn {
            font-size: 1.1rem;
        }

        .form-group input[type="file"] {
            font-size: 1rem;
        }

        .form-group textarea {
            font-size: 1rem;
        }

        /* Estilo do card de erro */
        .error-card {
            display: none;
            margin-top: 20px;
        }

        .error-card button {
            border: none;
            background-color: transparent;
            color: white;
            font-size: 1.2rem;
            float: right;
        }
    </style>
</head>

<body>
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
    <div class="container">
        <div class="card">
            <div class="card-header">
                Cadastrar Falta para Funcionário
            </div>
            <div class="card-body">
                <!-- Card de erro com botão de sair -->
                <div id="errorCard" class="card text-white bg-danger error-card">
                    <div class="card-body">
                        <strong>Erro:</strong> A data de início não pode ser maior que a data de fim.
                        <!-- Botão de fechar -->
                        <button type="button" onclick="fecharCard()" class="btn-close" aria-label="Fechar"></button>
                    </div>
                </div>

                <form action="{{ route('faltas.store', $funcionarioId) }}" method="POST" enctype="multipart/form-data" onsubmit="return validarDatas()">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="data_inicio">Data de Início:</label>
                        <input type="date" name="data_inicio" class="form-control" id="data_inicio" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="data_fim">Data de Fim:</label>
                        <input type="date" name="data_fim" class="form-control" id="data_fim" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="tipo_falta">Tipo de Falta:</label>
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

                            <optgroup label="Faltas Não Justificadas">
                                <option value="Ausência Sem Justificativa">Ausência Sem Justificativa</option>
                                <option value="Atraso">Atraso</option>
                                <option value="Saída Antecipada">Saída Antecipada</option>
                                <option value="Deserção de Função">Deserção de Função</option>
                            </optgroup>
                        </select>
                    </div>

                    <div class="form-group mb-3">
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

                    <button type="submit" class="btn btn-success">Registrar Falta</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Função para validar as datas
        function validarDatas() {
            var dataInicio = document.getElementById("data_inicio").value;
            var dataFim = document.getElementById("data_fim").value;

            // Verifica se as datas foram preenchidas
            if (dataInicio && dataFim) {
                if (new Date(dataInicio) > new Date(dataFim)) {
                    // Exibe a mensagem de erro no card
                    document.getElementById("errorCard").style.display = "block";
                    return false; // Impede o envio do formulário
                }
            }
            return true; // Permite o envio do formulário
        }

        // Função para fechar o card de erro
        function fecharCard() {
            document.getElementById("errorCard").style.display = "none";
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>