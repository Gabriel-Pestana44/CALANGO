<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = trim($_POST['id']);
    $filePath = 'Pergunta_DS.txt';
    $filePath2 = 'Pergunta_MS.txt';

    function excluirAluno($filePath, $id) {
        $perguntas = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $found = false;
        $newPergunta = [];

        foreach ($perguntas as $pergunta) {
            preg_match('/ID: (\w+)/', $pergunta, $matches);
            $perguntasId = $matches[1] ?? '';

            if ($perguntasId !== $id) {
                $newPergunta[] = $pergunta;
            } else {
                $found = true;
            }
        }

        if ($found) {
            file_put_contents($filePath, implode(PHP_EOL, $newPergunta) . PHP_EOL);
            return json_encode(["status" => "success", "message" => "Pergunta com ID $id excluída com sucesso!"]);
        } else {
            return json_encode(["status" => "error", "message" => "Pergunta com ID $id não encontrada."]);
        }
    }

    if (file_exists($filePath)) {
        echo excluirAluno($filePath, $id);
    } else if (file_exists($filePath2)) {
        echo excluirAluno($filePath2, $id);
    } else {
        echo json_encode(["status" => "error", "message" => "Arquivos de perguntas não encontrados."]);
    }
}
