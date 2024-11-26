<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Perguntas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 400px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0069d9;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .result {
            margin-top: 20px;
            text-align: center;
        }

        .pergunta {
            background-color: #e9ecef;
            padding: 10px;
            margin: 10px 0;
            border-radius: 8px;
        }

        .pergunta h3 {
            margin: 0;
        }

        .opcoes {
            text-align: center; /* Centraliza a lista de opções */
            list-style-type: none;
            padding: 0;
        }

        .opcoes li {
            margin: 5px 0; /* Margem entre as opções */
        }

        .opcoes input[type="radio"] {
            margin-right: 10px; /* Espaço entre o botão de opção e o texto */
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Listar Perguntas</h1>

    <form action="" method="POST">
        <label for="id">ID da Pergunta (deixe em branco para listar todas):</label>
        <input type="text" id="id" name="id">
        <button type="submit">Buscar</button>
    </form>

    <a href="index.php">Voltar para a Lista</a>

    <div class="result">
        <?php
        function listarPerguntas($filePath1, $filePath2, $id = null) {
            $perguntasDS = file($filePath1, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $perguntasMS = file($filePath2, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            $found = false;

            // Função para exibir perguntas discursivas
            function exibirPerguntaDiscursiva($id, $pergunta) {
                echo "<div class='pergunta'>";
                echo "<h3>Pergunta Discursiva (ID: $id)</h3>";
                echo "<p>$pergunta</p>";
                echo "<textarea rows='4' cols='50' placeholder='Responda aqui...'></textarea>";
                echo "</div>";
            }

            // Função para exibir perguntas de múltipla escolha
            function exibirPerguntaMultiplaEscolha($id, $pergunta, $resposta, $opcoes) {
                echo "<div class='pergunta'>";
                echo "<h3>Pergunta de Múltipla Escolha (ID: $id)</h3>";
                echo "<p>$pergunta</p>";
                echo "<ul class='opcoes'>";
                foreach ($opcoes as $opcao) {
                    echo "<li><input type='radio' name='pergunta_$id'> $opcao</li>"; // Remover padding-left
                }
                echo "</ul>";
                echo "</div>";
            }

            // Processa Perguntas Discursivas
            foreach ($perguntasDS as $linha) {
                preg_match('/ID: (\w+)\s*\|\s*Pergunta: (.+)\s*\|\s*Resposta: (.+)/', $linha, $matches);
                if ($matches) {
                    $perguntasId = $matches[1];
                    $textoPergunta = $matches[2];

                    if (!$id || $id == $perguntasId) {
                        exibirPerguntaDiscursiva($perguntasId, $textoPergunta);
                        $found = true;
                    }
                }
            }

            // Processa Perguntas de Múltipla Escolha
            foreach ($perguntasMS as $linha) {
                preg_match('/ID: (\w+)\s*\|\s*Pergunta: (.+)\s*\|\s*Resposta: (.+)\s*\|\s*Opção A: (.+)\s*\|\s*Opção B: (.+)\s*\|\s*Opção C: (.+)\s*\|\s*Opção D: (.+)/', $linha, $matches);
                if ($matches) {
                    $perguntasId = $matches[1];
                    $textoPergunta = $matches[2];
                    $resposta = $matches[3];
                    $opcoes = [
                        "Opção A: " . $matches[4],
                        "Opção B: " . $matches[5],
                        "Opção C: " . $matches[6],
                        "Opção D: " . $matches[7],
                    ];

                    if (!$id || $id == $perguntasId) {
                        exibirPerguntaMultiplaEscolha($perguntasId, $textoPergunta, $resposta, $opcoes);
                        $found = true;
                    }
                }
            }

            if (!$found) {
                echo "<p class='error'>Pergunta com ID <strong>$id</strong> não encontrada.</p>";
            }
        }

        // Chama a função para listar as perguntas
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = trim($_POST['id']);
            listarPerguntas('Pergunta_DS.txt', 'Pergunta_MS.txt', $id);
        }
        ?>
    </div>
</body>
</html>
