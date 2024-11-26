<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Alunos</title>
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
            background-color: #007bff; /* Cor de sucesso */
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
            color: #007bff; /* Cor do link */
            text-decoration: none; /* Remove o sublinhado */
        }

        a:hover {
            text-decoration: underline; /* Adiciona o sublinhado ao passar o mouse */
        }

        .result {
            margin-top: 20px;
            text-align: center;
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Listar Alunos</h1>

    <form action="" method="POST">
        <label for="matricula">Matrícula (deixe em branco para listar todos):</label>
        <input type="text" id="matricula" name="matricula">
        <button type="submit">Buscar</button>
    </form>

    <a href="index.php">Voltar para a Lista</a>

    <div class="result">
        <?php
        $filePath = 'Alunos.txt'; 

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $matricula = trim($_POST['matricula']);

            if (file_exists($filePath)) {
                $alunos = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                $found = false;

                
                if ($matricula !== '') {
                    foreach ($alunos as $aluno) {
                        if (strpos($aluno, "Matrícula: $matricula") !== false) {
                            echo "<p>$aluno</p>";
                            $found = true;
                        }
                    }
                    if (!$found) {
                        echo "<p class='error'>Aluno com matrícula <strong>$matricula</strong> não encontrado.</p>";
                    }
                } else {
                    
                    foreach ($alunos as $aluno) {
                        echo "<p>$aluno</p>";
                    }
                }
            } else {
                echo "<p class='error'>Arquivo de alunos não encontrado.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
