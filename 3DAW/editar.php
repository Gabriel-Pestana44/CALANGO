<?php
$id = $_GET['id'];
$disciplinas = file("disciplinas.txt");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sigla = $_POST['sigla'];
    $nome = $_POST['nome'];
    $carga_horaria = $_POST['carga_horaria'];

    $disciplinas[$id] = "Sigla: $sigla | Nome: $nome | Carga Horária: $carga_horaria\n";
    file_put_contents("disciplinas.txt", implode("", $disciplinas));
    header("Location: index.php");
    exit();
}

list($sigla, $nome, $carga_horaria) = explode("|", $disciplinas[$id]);
$sigla = trim(str_replace("Sigla: ", "", $sigla));
$nome = trim(str_replace("Nome: ", "", $nome));
$carga_horaria = trim(str_replace("Carga Horária: ", "", $carga_horaria));
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Disciplina</title>
</head>
<body>
    <h1>Editar Disciplina</h1>
    <form action="editar.php?id=<?php echo $id; ?>" method="POST">
        <label for="sigla">Sigla:</label>
        <input type="text" id="sigla" name="sigla" value="<?php echo $sigla; ?>" required><br><br>

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>" required><br><br>

        <label for="carga_horaria">Carga Horária:</label>
        <input type="number" id="carga_horaria" name="carga_horaria" value="<?php echo $carga_horaria; ?>" required><br><br>

        <button type="submit">Salvar</button>
    </form>
    <a href="index.php">Voltar</a>
</body>
</html>
