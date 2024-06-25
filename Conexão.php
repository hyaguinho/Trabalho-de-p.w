<?php


$banco_dados = "mysql:host=localhost;dbname=sistema_usuarios"; // Estabelece a string de conexão com o banco de dados
$usuario = "root"; // Define o nome de usuário para acessar o banco de dados
$senha = "1234"; // Define a senha (chave de acesso) para autenticação
$pdo = new PDO($banco_dados, $usuario, $senha); // Cria um objeto PDO para conectar ao banco de dados
