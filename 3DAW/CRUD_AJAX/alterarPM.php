<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = trim($_POST['id']);
    $novaPergunta = trim($_POST['pergunta']);
    $novaResposta = trim($_POST['resposta']);
    $novaOpcaoA = trim($_POST['opcaoA']);
    $novaOpcaoB = trim($_POST['opcaoB']);
    $novaOpcaoC = trim($_POST['opcaoC']);
    $novaOpcaoD = trim($_POST['opcaoD']);
    $filePath = 'Pergunta_MS.txt';

    if (!empty($id) && !empty($novaPergunta) && !empty($novaResposta) && !empty($novaOpcaoA) && !empty($novaOpcaoB) && !empty($novaOpcaoC) && !empty($novaOpcaoD)) {
        $linhas = file($filePath, FILE_IGNORE_NEW_LINES);
        $alterado = false;

        foreach ($linhas as &$linha) {
            if (strpos($linha, "ID: $id ") !== false) {
                $linha = "ID: $id | Pergunta: $novaPergunta | Resposta: $novaResposta | Opção A: $novaOpcaoA | Opção B: $novaOpcaoB | Opção C: $novaOpcaoC | Opção D: $novaOpcaoD";
                $alterado = true;
                break;
            }
        }

        if ($alterado) {
            file_put_contents($filePath, implode(PHP_EOL, $linhas) . PHP_EOL);
            echo json_encode(["status" => "success", "message" => "Pergunta de Múltipla Escolha alterada com sucesso!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Pergunta com ID $id não encontrada."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Todos os campos são obrigatórios."]);
    }
}
