<?php

include ('Conexão.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = 'DELETE FROM livros WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if($stmt->execute()){
        echo "Produto deletado com sucesso";
    }else {
        echo "Erro ao deletar produto: " . $stmt->errorInfo()[2];
    }

    $pdo = null; // Fechar a conexão com o banco de dados
}

header("Location: pagprincipal.php");
exit;