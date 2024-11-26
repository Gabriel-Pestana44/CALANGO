<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>

    <style>
        /* Estilizando o botão */
        button {
            background-color: #4CAF50; /* Verde */
            color: white; /* Cor do texto branco */
            padding: 15px 32px; /* Espaçamento interno */
            text-align: center; /* Centraliza o texto */
            font-size: 16px; /* Tamanho do texto */
            border: none; /* Remove bordas */
            border-radius: 8px; /* Bordas arredondadas */
            cursor: pointer; /* Ícone de mão ao passar o mouse */
            transition: background-color 0.3s ease; /* Transição suave */
            margin: 10px; /* Espaçamento entre os botões */
            height: 80px;
            width: 180px;
        }

        /* Efeito ao passar o mouse no botão */
        button:hover {
            background-color: #45a049; /* Verde mais escuro */
        }

        /* Estilizando o contêiner */
        .button-container {
            display: flex;
            justify-content: center; /* Centraliza os botões horizontalmente */
            align-items: center; /* Centraliza os botões verticalmente */
            flex-direction: column; /* Coloca os botões em uma coluna */
            height: 100vh; /* Ocupa toda a altura da página */
        }

        /* Remover estilos padrão de listas */
        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
    </style>
</head>
<body>

    <div class="button-container">
        <ul>
            <li><a href="incluir.php"><button>Incluir Aluno</button></a></li>
            <li><a href="excluir.php"><button>Excluir Aluno</button></a></li>
            <li><a href="alterar.php"><button>Alterar Aluno</button></a></li>
            <li><a href="listar.php"><button> Listar Aluno  </button></a></li>
        </ul>
    </div>

</body>
</html>
