<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Aluno</title>
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

        input[type="text"],
        input[type="date"] {
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
    <h1>Alterar Pergunta Discursiva</h1>

    <h1>Criar Pergunta Discursiva</h1>
    <form action="" method="POST">
        
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" required>
        
        <label for="pergunta">Pergunta:</label>
        <input type="text" id="pergunta" name="pergunta" required>

        <label for="resposta">Resposta:</label>
        <input type="text" id="resposta" name="resposta" required>

        <button type="submit">Cadastrar Pergunta</button>
    </form>

    <a href="index.php">Voltar para a Lista</a>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = trim($_POST['id']);
        $pergunta = trim($_POST['pergunta']);
        $resposta = trim($_POST['resposta']);
        $filePath = 'Pergunta_DS.txt'; 

        if (file_exists($filePath)) {
            $perguntas = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $found = false;
            $newPergunta = [];

            foreach ($perguntas as $pergunta) {
                
                preg_match('/ID: (\w+)/', $pergunta, $matches);
                $idPergunta = $matches[1] ?? '';

                if ($idPergunta === $id) {
                  
                    $newPergunta[] = "ID: $id | Pergunta: $pergunta | Resposta: $resposta \n";
                    $found = true; 
                } else {
                    $newPergunta[] = $pergunta; 
                }
            }

            
            if ($found) {
                file_put_contents($filePath, implode(PHP_EOL, $newPergunta) . PHP_EOL);
                echo "<p>Pergunta com ID: <strong>$id</strong> alterado com sucesso!</p>";
            } else {
                echo "<p class='error'>Pergunta com ID: <strong>$id</strong> não encontrado.</p>";
            }
        } else {
            echo "<p class='error'>Arquivo de Perguntas não encontrado.</p>";
        }
    }
    ?>
</body>
</html>