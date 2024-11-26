<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = trim($_POST['id']);

    function listarPerguntas($filePath1, $filePath2, $id = null) {
        $perguntasDS = file($filePath1, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $perguntasMS = file($filePath2, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $result = [];

        foreach ($perguntasDS as $linha) {
            preg_match('/ID: (\w+)\s*\|\s*Pergunta: (.+)\s*\|\s*Resposta: (.+)/', $linha, $matches);
            if ($matches) {
                $perguntasId = $matches[1];
                $textoPergunta = $matches[2];

                if (!$id || $id == $perguntasId) {
                    $result[] = ["id" => $perguntasId, "tipo" => "discursiva", "pergunta" => $textoPergunta];
                }
            }
        }

        foreach ($perguntasMS as $linha) {
            preg_match('/ID: (\w+)\s*\|\s*Pergunta: (.+)\s*\|\s*Resposta: (.+)\s*\|\s*Opção A: (.+)\s*\|\s*Opção B: (.+)\s*\|\s*Opção C: (.+)\s*\|\s*Opção D: (.+)/', $linha, $matches);
            if ($matches) {
                $perguntasId = $matches[1];
                $textoPergunta = $matches[2];
                $opcoes = [
                    "A" => $matches[4],
                    "B" => $matches[5],
                    "C" => $matches[6],
                    "D" => $matches[7]
                ];

                if (!$id || $id == $perguntasId) {
                    $result[] = ["id" => $perguntasId, "tipo" => "multipla", "pergunta" => $textoPergunta, "opcoes" => $opcoes];
                }
            }
        }

        return json_encode($result);
    }

    echo listarPerguntas('Pergunta_DS.txt', 'Pergunta_MS.txt', $id);
}
