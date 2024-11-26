<!DOCTYPE html>
<!--- codigo alterado para ficar mais organizado: adiçao das funcionalidades excluir e listar, melhoria nas funcionalidades de adicionar 
e de alterar | codigo comentado nas principais funcionalidades!!! -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina principal</title>

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
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            align-items: center;
        }

        button:hover {
            background-color: #218838;
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

        .normal {
            color: #28a745;
            text-align: center;
        }
    </style>
    
</head>
<body>

<h1>Cadastro</h1>
    <form action="" method="POST">
        <h2>Digite seu Email</h2>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>

        <h2>Crie sua Senha</h2>
        <label for="senha">Senha:</label>
        <input type="text" id="senha" name="senha" required>

        <button type="submit">Cadastrar</button>
    </form>

</body>
</html>

<?php
$sucess_cadastro = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if (!empty($email) && !empty($senha)) {
        $linha = "Email: $email | Senha: $senha\n";
        $arquivo = fopen("Cadastro_Usuario.txt", "a");

        if ($arquivo) {
            fwrite($arquivo, $linha);
            fclose($arquivo);
            echo "<p class='normal'>Conta criada com sucesso!</p>";
            $sucess_cadastro = true;
        } else {
            echo "<p class='error'>Erro ao abrir o arquivo.</p>";
            echo "<button onclick=\"window.location.href='index.php'\">Continuar</button>";
        }
    } else {
        echo "<p class='error'>Preencha todos os campos!</p>";
    }
}
if($sucess_cadastro){
    echo "<div style='display: flex; justify-content: center; align-items: center; margin-top: 20px;'>
            <button style='width: 50%; padding: 10px; font-size: 16px;' onclick=\"window.location.href='index.php'\">Continuar</button>
          </div>";
}
?>