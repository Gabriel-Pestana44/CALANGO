<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Perguntas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .hidden {
            display: none;
        }
        form {
            margin-bottom: 20px;
            padding: 10px;
            background: white;
            border: 1px solid #ccc;
            
        }
    </style>
    <!--esconder esse treco-->
    <script>
        function toggleOptions(action) {
            const options = document.querySelectorAll('.options');
            options.forEach(option => option.classList.add('hidden'));
            if (action) {
                document.getElementById(action).classList.remove('hidden');
            }
        }
    </script>
</head>
<body>
    <h1>CRUD de Perguntas</h1>
    <form method="POST" action="">
        <label for="id">ID:</label>
        <input type="text" name="id" id="id" required><br><br>

        <label for="pergunta">Pergunta:</label>
        <input type="text" name="pergunta" id="pergunta" required><br><br>

        <label for="acao">Ação:</label>
        <select name="acao" id="acao" onchange="toggleOptions(this.value)">
            <option value="">Selecione uma ação</option>
            <option value="cadastrar">Cadastrar</option>
            <option value="excluir">Excluir</option>
            <option value="alterar">Alterar</option>
            <option value="listar">Listar</option>
            <option value="listar_uma">Listar Uma</option>
        </select><br><br>

        <div id="cadastrar" class="options hidden">
            <h3>Cadastrar Pergunta</h3>
            <label for="opcaoA">Opção A:</label>
            <input type="text" name="opcaoA" required><br><br>
            <label for="opcaoB">Opção B:</label>
            <input type="text" name="opcaoB" required><br><br>
            <label for="opcaoC">Opção C:</label>
            <input type="text" name="opcaoC" required><br><br>
            <label for="opcaoD">Opção D:</label>
            <input type="text" name="opcaoD" required><br><br>
            <label for="gabarito">Gabarito:</label>
            <input type="text" name="gabarito" required><br><br>
        </div>

        <div id="excluir" class="options hidden">
            <h3>Excluir Pergunta</h3>
            <p>Para excluir, apenas forneça o ID da pergunta.</p>
        </div>

        <div id="alterar" class="options hidden">
            <h3>Alterar Pergunta</h3>
            <label for="opcaoA">Nova Opção A:</label>
            <input type="text" name="opcaoA" required><br><br>
            <label for="opcaoB">Nova Opção B:</label>
            <input type="text" name="opcaoB" required><br><br>
            <label for="opcaoC">Nova Opção C:</label>
            <input type="text" name="opcaoC" required><br><br>
            <label for="opcaoD">Nova Opção D:</label>
            <input type="text" name="opcaoD" required><br><br>
            <label for="gabarito">Novo Gabarito:</label>
            <input type="text" name="gabarito" required><br><br>
        </div>

        <div id="listar" class="options hidden">
            <h3>Listar Perguntas</h3>
            <p>As perguntas serão listadas na tela.</p>
        </div>

        <div id="listar_uma" class="options hidden">
            <h3>Listar Uma Pergunta</h3>
            <p>Para listar, apenas forneça o ID da pergunta.</p>
        </div>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>



<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $pergunta = $_POST['pergunta'];
    $opcaoA = $_POST['opcaoA'];
    $opcaoB = $_POST['opcaoB'];
    $opcaoC = $_POST['opcaoC'];
    $opcaoD = $_POST['opcaoD'];
    $gabarito = $_POST['gabarito'];
    $acao = $_POST['acao'];

    if ($acao == "cadastrar") {
        if (!empty($pergunta) && !empty($id) && !empty($opcaoA) && !empty($opcaoB) && !empty($opcaoC) && !empty($opcaoD)) {
            $questao = "id: $id | Pergunta: $pergunta\n\n Opcao A: $opcaoA\n Opcao B: $opcaoB\n Opcao C: $opcaoC\n Opcao D: $opcaoD\n Gabarito: $gabarito\n\n";
            $arquivo = fopen("multiplaEscolha.txt", "a");
            fwrite($arquivo, $questao);
            fclose($arquivo);
            echo "<p>Pergunta cadastrada com sucesso!</p>";
        } else {
            echo "<p>Por favor, preencha todos os campos!</p>";
        }
    } elseif ($acao == "excluir") {
        if (!empty($id)) {
            $linhas = file("multiplaEscolha.txt");
            $arquivo = fopen("multiplaEscolha.txt", "w");
            foreach ($linhas as $linha) {
                if (strpos($linha, "id: $id |") === false) {
                    fwrite($arquivo, $linha);
                }
            }
            fclose($arquivo);
            echo "<p>Pergunta excluída com sucesso!</p>";
        } else {
            echo "<p>Por favor, forneça o ID da pergunta para excluir!</p>";
        }
    } elseif ($acao == "listar") {
        $linhas = file("multiplaEscolha.txt");
        echo "<h2>Lista de Perguntas</h2>";
        foreach ($linhas as $linha) {
            echo "<p>$linha</p>";
        }
    } elseif ($acao == "alterar") {
        if (!empty($id) && !empty($pergunta) && !empty($opcaoA) && !empty($opcaoB) && !empty($opcaoC) && !empty($opcaoD)) {
            $linhas = file("multiplaEscolha.txt");
            $arquivo = fopen("multiplaEscolha.txt", "w");
            foreach ($linhas as $linha) {
                if (strpos($linha, "id: $id |") === false) {
                    fwrite($arquivo, $linha);
                } else {
                    $questao = "id: $id | Pergunta: $pergunta\n\n Opcao A: $opcaoA\n Opcao B: $opcaoB\n Opcao C: $opcaoC\n Opcao D: $opcaoD\n Gabarito: $gabarito\n\n";
                    fwrite($arquivo, $questao);
                }
            }
            fclose($arquivo);
            echo "<p>Pergunta alterada com sucesso!</p>";
        } else {
            echo "<p>Por favor, preencha todos os campos para alterar a pergunta!</p>";
        }
    } elseif ($acao == "listar_uma") {
        if (!empty($id)) {
            $linhas = file("multiplaEscolha.txt");
            $encontrada = false;
            foreach ($linhas as $linha) {
                if (strpos($linha, "id: $id |") !== false) {
                    echo "<p>$linha</p>";
                    $encontrada = true;
                    break;
                }
            }
            if (!$encontrada) {
                echo "<p>Pergunta com ID $id não encontrada!</p>";
            }
        } else {
            echo "<p>Por favor, forneça o ID da pergunta para listar!</p>";
        }
    }
}
?>