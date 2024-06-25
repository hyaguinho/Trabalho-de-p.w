<?php

require 'Conexão.php'; // Inclui o arquivo de conexão com o banco de dados

// Obtém os valores enviados via POST

$nome = $_POST["nome"];
$senha = $_POST["senha"];
$data_nascimento = $_POST["data_nascimento"];
$endereco = $_POST["endereco"];
$email = $_POST["email"];

//-----------------------------------------------------------------\\

// Define a consulta SQL para inserção de dados

$sql = 'INSERT INTO cadastro_usuarios( nome, senha, data_nascimento, endereco, email) VALUES(:nome, :senha, :data_nascimento,:endereco, :email)';

//-------------------------------------------------------------------\\


$stmt = $pdo->prepare($sql); // Prepara a consulta

// Executa a consulta com os valores fornecidos

$nlinhas = $stmt->execute([

    ':nome' => $nome,
    ':senha' => $senha,
    ':data_nascimento' => $data_nascimento,
    ':endereco' => $endereco,
    ':email' => $email   
                   
]);

//------------------------------------------------------------------\\

//Redireciona para a pagina login 

header("Location:paglogin.html");
exit();

