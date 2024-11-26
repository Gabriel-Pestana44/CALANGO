<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Disciplina</title>
</head>
<body>
    <h1>Cadastrar Nova Disciplina</h1>
    <form action="cadastrar.php" method="POST">
        <label for="sigla">Sigla:</label>
        <input type="text" id="sigla" name="sigla" required><br><br>

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="carga_horaria">Carga Horária:</label>
        <input type="number" id="carga_horaria" name="carga_horaria" required><br><br>

        <button type="submit">Cadastrar</button>
    </form>

    <a href="index.php">Voltar para a Lista</a>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sigla = $_POST['sigla'];
        $nome = $_POST['nome'];
        $carga_horaria = $_POST['carga_horaria'];

        if (!empty($sigla) && !empty($nome) && !empty($carga_horaria)) {
            $linha = "Sigla: $sigla | Nome: $nome | Carga Horária: $carga_horaria\n";
            $arquivo = fopen("disciplinas.txt", "a");
            fwrite($arquivo, $linha);
            fclose($arquivo);
            echo "<p>Disciplina cadastrada com sucesso!</p>";
        } else {
            echo "<p>Por favor, preencha todos os campos!</p>";
        }
    }
    ?>
</body>
</html>
