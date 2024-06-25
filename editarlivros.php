<?php
if(!empty($_GET['id']))
{
    include_once('Conexão.php');

    $id = $_GET['id'];

    $sql= "SELECT * FROM livros WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    if($stmt->rowCount() > 0)
    {
        while ($user = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $nome = $user['nome'];
            $autor = $user['autor'];
            $titulo = $user['titulo'];
            $subtitulo = $user['subtitulo'];
            $edicao = $user['edicao'];
            $data_de_publicacao = $user['data_de_publicacao'];
            $imagem = $user['imagem'];
        }
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadastrolivros.css">
    <link rel="shortcut icon" href="icons/favicon.ico" type="image/x-icon">
    <title>Pagina cadastro de livros</title>
</head>
<body>

    <div class="posici">
        <div class="test">
            <div class="container">
                <div class="banner">
                    <img src="img/download.gif" alt="Cadeado">
                    <h1>Olá, Sejá Bem-Vindo(a) 👋</h1>
                    <h4>Bora Cadastrar seu livro?</h4>
                </div>
            </div>

            <form  method="get" enctype="multipart/form-data">
                <div class="posi">
                    <label>Nome:</label>
                    <input name="nome" type="text" placeholder="Nome" value="<?php $nome ?>">

                    <label>Autor:</label>
                    <input name="autor" type="text" placeholder="Autor" value="<?php $autor ?>">

                    <label>Titulo:</label>
                    <input name="titulo" type="text" placeholder="Titulo" value="<?php $titulo ?>">

                    <label>Subtitulo:</label>
                    <input name="subtitulo" type="text" placeholder="Subtitulo" value="<?php $subtitulo ?>">

                    <label>Edição:</label>
                    <input name="edicao" type="text" placeholder="Edição" value="<?php $edicao ?>">

                    <label>Data de Publicação:</label>
                    <input id="data" name="data_de_publicacao" type="date" placeholder="Data de publicação" value="<?php $data_de_publicacao ?>">

                    <label>Capa do livro:</label>
                    <input name="imagem" type="file" id="label" accept="image/jpeg, image/png"  value="<?php $imagem ?>"/>
                    <button type="submit">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>