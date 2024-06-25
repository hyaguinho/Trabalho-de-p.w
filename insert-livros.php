<?php

 
require_once 'Conexão.php'; // Inclui o arquivo de conexão


global $pdo; // Inicializa o objeto PDO


session_start();// Inicia a sessão

//Verifica se o usuário está logado

if (empty($_SESSION["id"])) {
    header("Location: paglogin.html");
    exit();
}

//---------------------------------------------------------------\\

// Obtém os valores postados

$nome = $_POST["nome"];
$autor = $_POST["autor"];
$titulo = $_POST["titulo"];
$subtitulo = $_POST["subtitulo"];
$edicao = $_POST["edicao"];
$data_de_publicacao = $_POST["data_de_publicacao"];

//---------------------------------------------------------------\\

// Manipula a imagem enviada

if (isset($_FILES['imagem'])) {
    $arquivo = $_FILES['imagem'];

    if ($arquivo['error']) {
        header('Location: erro.php?msg=Falha ao enviar arquivo');
        exit();
    }

    $pasta = "arquivo/";
    $nomeDoArquivo = $arquivo['name'];
    $extensão = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
    $novoNomeDoArquivo = uniqid(). ".". $extensão;
    $caminho = $pasta. $novoNomeDoArquivo;

    $certo = move_uploaded_file($arquivo["tmp_name"], $caminho);

    if ($certo) {
        echo "<p>Arquivo enviado com sucesso! <a href=\"arquivo/$novoNomeDoArquivo\">Aqui</a></p>";
    }
}

//----------------------------------------------------------------------\\

//Define a consulta SQL para inserção de dados

$sql = 'INSERT INTO livros (nome, autor, titulo, subtitulo, edicao, data_de_publicacao, capa, id_usuarios) VALUES (:nome, :autor, :titulo, :subtitulo, :edicao, :data_de_publicacao, :capa, :id_usuarios)';

//----------------------------------------------------------------------\\

// Prepara a consulta

$stmt = $pdo->prepare($sql);

//-----------------------------------------------------------------------\\

//Executa a consulta com os valores fornecidos

$nlinhas = $stmt->execute([
    ':nome' => $nome,
    ':autor' => $autor,
    ':titulo' => $titulo,
    ':subtitulo' => $subtitulo,
    ':edicao' => $edicao,
    ':data_de_publicacao' => $data_de_publicacao,
    ':capa' => $caminho,
    ':id_usuarios' => $_SESSION['id']
]);

//------------------------------------------------------------------------\\

//Verifica se a inserção foi bem sucedida

if ($nlinhas > 0) {
    echo 'Livro cadastrado com sucesso!';
} else {
    echo 'Erro ao cadastrar o livro.';
}

//-------------------------------------------------------------------------\\

// Redireciona para a pagina principal

header("Location: pagprincipal.php");
exit();

