<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/pagprincipal.css">
    <link rel="shortcut icon" href="icons/favicon.ico" type="image/x-icon">
    <title>Pagina Principal</title>
</head>
<body>

    <nav>
        <a id="Titulo">Meus Livros</a>
        <div class="Conteudo">
            <form action="">
                <input type="search" name="barra-pesquisa" id="" placeholder="🔎 Pesquisar Livros">
            </form>
            <a href="deslogar.php">Sair</a>
            <a href="#">⚙️</a>
            <a href="#">🔔</a>
            <a href="pagcadastrolivros.html">📚</a>
        </div>
    </nav>

    <?php
        require 'Conexão.php';
        session_start();

        if (empty($_SESSION["id"])) {
            header("location: paglogin.html");
        }

        $stmt = $pdo->prepare('SELECT * FROM livros  WHERE id_usuarios = :id');
        $stmt->execute([
            ':id' => $_SESSION['id']
        ]);
   ?>

    <div class="alinha">
        <table>
            <tr>
                <th>Capa</th>
                <th>Nome</th>
                <th>Autor</th>
                <th>Título</th>
                <th>Subtítulo</th>
                <th>Edição</th>
                <th>Data de Publicação</th>
                <th>Excluir</th>
                <th>Editar</th>
            </tr>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {?>
            <tr>
                <td><img src="<?= $row['capa']?>" alt="" width="200px" height="100px"></td>
                <td><?= $row['nome']?></td>
                <td><?= $row['autor']?></td>
                <td><?= $row['titulo']?></td>
                <td><?= $row['subtitulo']?></td>
                <td><?= $row['edicao']?></td>
                <td><?= $row['data_de_publicacao']?></td>
                <td> <form action="Delete.php" method="get">
                <input type="hidden" name="id" value="<?= $row['id']?>">
                <button type="submit">🗑️</button>
                </form></td>
                <td><a href="editarlivros.php?id=$row[id]">✏️</a></td>
            </tr>
            <?php }?>
        </table>
        
    </div>

</body>
</html>