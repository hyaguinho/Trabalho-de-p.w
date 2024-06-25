<?php
require 'Conexão.php'; // Inclui o arquivo de conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Verifica se a requisição foi feita via método POST
   
    // Obtém os valores enviados via POST
   
    $nome = $_POST["nome"];
    $senha = $_POST["senha"];
    $endereco = $_POST["endereco"];
    $email = $_POST["email"];

//--------------------------------------------------------------------------------\\

    // Define a consulta SQL para verificar o usuário

    $sql = "SELECT * FROM cadastro_usuarios WHERE nome = :nome AND senha = :senha AND endereco = :endereco AND email = :email";

    $stmt = $pdo->prepare($sql); // Prepara a consulta

    // Vincula os parâmetros
   
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
    $stmt->bindParam(':endereco', $endereco, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    $stmt->execute(); // Executa a consulta
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC); // Obtém o resultado da consulta

    var_dump($resultado);

    if ($_POST["senha"] == $resultado["senha"]) {
        if (count($resultado) != 0) {
            if (!isset($_SESSION)) {
                session_start();
            }

            $_SESSION["id"] = $resultado["id"];
            $_SESSION["nome"] = $resultado["nome"];

            header("location: pagprincipal.php");
            exit;
        } else {
            echo "Não deu certo";
        }
    }
}