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
    <h1>Alterar Aluno</h1>

    <form action="" method="POST">
        <label for="matricula">Matrícula:</label>
        <input type="text" id="matricula" name="matricula" required>
        
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required>
        
        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" required>

        <button type="submit">Alterar</button>
    </form>

    <a href="index.php">Voltar para a Lista</a>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $matricula = trim($_POST['matricula']);
        $nome = trim($_POST['nome']);
        $cpf = trim($_POST['cpf']);
        $data_nascimento = trim($_POST['data_nascimento']);
        $filePath = 'Alunos.txt'; 

        if (file_exists($filePath)) {
            $alunos = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $found = false;
            $newAlunos = [];

            foreach ($alunos as $aluno) {
                
                preg_match('/Matrícula: (\w+)/', $aluno, $matches);
                $alunoMatricula = $matches[1] ?? '';

                if ($alunoMatricula === $matricula) {
                  
                    $newAlunos[] = "Nome: $nome | CPF: $cpf | Data de nascimento: $data_nascimento | Matrícula: $matricula";
                    $found = true; 
                } else {
                    $newAlunos[] = $aluno; 
                }
            }

            
            if ($found) {
                file_put_contents($filePath, implode(PHP_EOL, $newAlunos) . PHP_EOL);
                echo "<p>Aluno com matrícula <strong>$matricula</strong> alterado com sucesso!</p>";
            } else {
                echo "<p class='error'>Aluno com matrícula <strong>$matricula</strong> não encontrado.</p>";
            }
        } else {
            echo "<p class='error'>Arquivo de alunos não encontrado.</p>";
        }
    }
    ?>
</body>
</html>
