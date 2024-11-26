<?php
$id = $_GET['id'];
$disciplinas = file("disciplinas.txt");
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
    <title>Visualizar Disciplina</title>
</head>
<body>
    <h1>Detalhes da Disciplina</h1>
    <p><strong>Sigla:</strong> <?php echo $sigla; ?></p>
    <p><strong>Nome:</strong> <?php echo $nome; ?></p>
    <p><strong>Carga Horária:</strong> <?php echo $carga_horaria; ?> horas</p>

    <a href="index.php">Voltar</a>
</body>
</html>
