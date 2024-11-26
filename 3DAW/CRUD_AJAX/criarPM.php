<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = trim($_POST['id']);
    $pergunta = trim($_POST['pergunta']);
    $resposta = trim($_POST['resposta']);
    $opcaoA = trim($_POST['opcaoA']);
    $opcaoB = trim($_POST['opcaoB']);
    $opcaoC = trim($_POST['opcaoC']);
    $opcaoD = trim($_POST['opcaoD']);
    $filePath = 'Pergunta_MS.txt';

    if (!empty($id) && !empty($pergunta) && !empty($resposta) && !empty($opcaoA) && !empty($opcaoB) && !empty($opcaoC) && !empty($opcaoD)) {
        $linha = "ID: $id | Pergunta: $pergunta | Resposta: $resposta | Opção A: $opcaoA | Opção B: $opcaoB | Opção C: $opcaoC | Opção D: $opcaoD" . PHP_EOL;
        file_put_contents($filePath, $linha, FILE_APPEND);
        echo json_encode(["status" => "success", "message" => "Pergunta de Múltipla Escolha criada com sucesso!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Todos os campos são obrigatórios."]);
    }
}
