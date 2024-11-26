
<?php
         
            if (file_exists("disciplinas.txt") && filesize("disciplinas.txt") > 0) {

                $arquivo = fopen("disciplinas.txt", "r");

              
                while (($linha = fgets($arquivo)) !== false) {
                    // Divide a linha em sigla, nome e carga horária usando o separador "|"
                    list($sigla, $nome, $carga_horaria) = explode("|", $linha);

                   
                    $sigla = trim(str_replace("Sigla: ", "", $sigla));
                    $nome = trim(str_replace("Nome: ", "", $nome));
                    $carga_horaria = trim(str_replace("Carga Horária: ", "", $carga_horaria));

                    echo "<tr>";
                    echo "<td>$sigla</td>";
                    echo "<td>$nome</td>";
                    echo "<td>$carga_horaria</td>";
                    echo "</tr>";
                }

                // Fecha o arquivo após a leitura
                fclose($arquivo);
            } else {
                echo "<tr><td colspan='3'>Nenhuma disciplina cadastrada.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <br>
    <a href="index.php">Cadastrar Nova Disciplina</a>
</body>
</html>
