<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = trim($_POST['id']);
    $novaPergunta = trim($_POST['pergunta']);
    $novaResposta = trim($_POST['resposta']);
    $filePath = 'Pergunta_DS.txt';

    if (!empty($id) && !empty($novaPergunta) && !empty($novaResposta)) {
        $linhas = file($filePath, FILE_IGNORE_NEW_LINES);
        $alterado = false;

        foreach ($linhas as &$linha) {
            if (strpos($linha, "ID: $id ") !== false) {
                $linha = "ID: $id | Pergunta: $novaPergunta | Resposta: $novaResposta";
                $alterado = true;
                break;
            }
        }

        if ($alterado) {
            file_put_contents($filePath, implode(PHP_EOL, $linhas) . PHP_EOL);
            echo json_encode(["status" => "success", "message" => "Pergunta Discursiva alterada com sucesso!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Pergunta com ID $id não encontrada."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Todos os campos são obrigatórios."]);
    }
}
