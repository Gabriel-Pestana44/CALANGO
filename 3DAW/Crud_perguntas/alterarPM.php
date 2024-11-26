<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Pergunta</title>
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

        p {
            text-align: center;
            color: #28a745;
            margin-top: 20px;
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Alterar Pergunta</h1>
    <form action="" method="POST">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" required>
        
        <label for="pergunta">Pergunta:</label>
        <input type="text" id="pergunta" name="pergunta" required>

        <label for="resposta">Resposta:</label>
        <input type="text" id="resposta" name="resposta" required>

        <label for="opcaoA">Opção A:</label>
        <input type="text" id="opcaoA" name="opcaoA" required>

        <label for="opcaoB">Opção B:</label>
        <input type="text" id="opcaoB" name="opcaoB" required>

        <label for="opcaoC">Opção C:</label>
        <input type="text" id="opcaoC" name="opcaoC" required>

        <label for="opcaoD">Opção D:</label>
        <input type="text" id="opcaoD" name="opcaoD" required>

        <button type="submit">Alterar Pergunta</button>
    </form>

    <a href="index.php">Voltar para a Lista</a>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $pergunta = $_POST['pergunta'];
        $id = $_POST['id'];
        $resposta = $_POST['resposta'];
        $opcaoA = $_POST['opcaoA'];
        $opcaoB = $_POST['opcaoB'];
        $opcaoC = $_POST['opcaoC'];
        $opcaoD = $_POST['opcaoD'];
        $filePath = 'Pergunta_MS.txt'; 

        if (file_exists($filePath)) {
            $perguntas = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $found = false;
            $newPergunta = [];

            foreach ($perguntas as $linha) {
                preg_match('/ID: (\w+)/', $linha, $matches);
                $idPergunta = $matches[1] ?? '';

                if ($idPergunta === $id) {
                    // Cria uma nova linha formatada com as informações novas
                    $newPergunta[] = "ID: $id | Pergunta: $pergunta | Resposta: $resposta | Opção A: $opcaoA | Opção B: $opcaoB | Opção C: $opcaoC | Opção D: $opcaoD";
                    $found = true; 
                } else {
                    $newPergunta[] = $linha; 
                }
            }

            if ($found) {
                // Escreve no arquivo, removendo a última nova linha para evitar uma linha em branco extra
                file_put_contents($filePath, implode(PHP_EOL, $newPergunta) . PHP_EOL);
                echo "<p>Pergunta com ID: <strong>$id</strong> alterada com sucesso!</p>";
            } else {
                echo "<p class='error'>Pergunta com ID: <strong>$id</strong> não encontrada.</p>";
            }
        } else {
            echo "<p class='error'>Arquivo de Perguntas não encontrado.</p>";
        }
    }
    ?>
</body>
</html>
