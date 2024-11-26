<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = trim($_POST['id']);
    $pergunta = trim($_POST['pergunta']);
    $resposta = trim($_POST['resposta']);
    $filePath = 'Pergunta_DS.txt';

    if (!empty($id) && !empty($pergunta) && !empty($resposta)) {
        $linha = "ID: $id | Pergunta: $pergunta | Resposta: $resposta" . PHP_EOL;
        file_put_contents($filePath, $linha, FILE_APPEND);
        echo json_encode(["status" => "success", "message" => "Pergunta Discursiva criada com sucesso!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Todos os campos são obrigatórios."]);
    }
}
