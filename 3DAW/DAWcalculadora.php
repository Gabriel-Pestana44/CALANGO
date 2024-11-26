<?php

$v1 = isset($_GET["a"]) ? $_GET["a"] : 0;
$v2 = isset($_GET["b"]) ? $_GET["b"] : 0;
$vopcao = isset($_GET["opcao"]) ? $_GET["opcao"] : '';

$vresult = 0;

switch ($vopcao) {  
    case 'soma':
        $vresult = $v1 + $v2;
        break;
    case 'subtracao':
        $vresult = $v1 - $v2;
        break;
    case 'multiplicacao':
        $vresult = $v1 * $v2;
        break;
    case 'divisao':
        if ($v2 != 0) {  
            $vresult = $v1 / $v2;
        } else {
            $vresult = 'Erro!!!';
        }
        break;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
    <style>
        body {
            background-color: #363d9e;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
        }

        form {
            background-color: #a3627d;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        input, select, button {
            margin: 10px 0;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
        }

        h1 {
            color: #000000;
        }
    </style>
</head>
<body>
    <form method="get" name="calculator">
        <input type="text" name="a" placeholder="num1" required><br>
        <input type="text" name="b" placeholder="num2" required><br>
        <select name="opcao" required>
            <option value="soma">Soma</option>
            <option value="subtracao">Subtracao</option>
            <option value="multiplicacao">Multiplicacao</option>
            <option value="divisao">Divisao</option>
        </select>
        <button type="submit">Calcular</button>
    </form>
    <br>

    <?php 
    if ($vopcao) { 
        echo "<h1>Resultado: $vresult</h1>";
    }
    ?>

</body>
</html>
