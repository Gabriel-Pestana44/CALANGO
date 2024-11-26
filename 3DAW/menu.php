<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Disciplinas</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 18px;
            text-align: left;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <h1>Lista de Disciplinas Cadastradas</h1>

    <table>
        <thead>
            <tr>
                <th>Sigla</th>
                <th>Nome da Disciplina</th>
                <th>Carga Horária</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (file_exists("disciplinas.txt") && filesize("disciplinas.txt") > 0) {
                $arquivo = fopen("disciplinas.txt", "r");
                $id = 0;
                while (($linha = fgets($arquivo)) !== false) {
                    list($sigla, $nome, $carga_horaria) = explode("|", $linha);
                    $sigla = trim(str_replace("Sigla: ", "", $sigla));
                    $nome = trim(str_replace("Nome: ", "", $nome));
                    $carga_horaria = trim(str_replace("Carga Horária: ", "", $carga_horaria));

                    echo "<tr>";
                    echo "<td>$sigla</td>";
                    echo "<td>$nome</td>";
                    echo "<td>$carga_horaria</td>";
                    echo "<td>
                            <a href='visualizar.php?id=$id'>Visualizar</a> |
                            <a href='editar.php?id=$id'>Editar</a> |
                            <a href='excluir.php?id=$id'>Excluir</a>
                          </td>";
                    echo "</tr>";
                    $id++;
                }
                fclose($arquivo);
            } else {
                echo "<tr><td colspan='4'>Nenhuma disciplina cadastrada.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <br>
    <a href="cadastrar.php">Cadastrar Nova Disciplina</a>
</body>
</html>
