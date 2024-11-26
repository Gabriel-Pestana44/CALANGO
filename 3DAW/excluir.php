<?php
$id = $_GET['id'];
$disciplinas = file("disciplinas.txt");
unset($disciplinas[$id]);
file_put_contents("disciplinas.txt", implode("", $disciplinas));
header("Location: index.php");
exit();
?>
