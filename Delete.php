<?php

include ('Delete.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = 'DELETE FROM livro WHERE id = $id';

    if($Conexão->query($sql) === TRUE){
        echo "Produto deletado com sucesso";
    }else {
        echo "Erro ao deletar produto: ". $Conexão->error;
    }

    $Conexão->close();
}

header("Location: pagprincipal.php");
exit;