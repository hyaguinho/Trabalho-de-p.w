<?php


if (!isset($_SESSION)) { // Verifica se a sessão não está definida

    session_start(); // Inicia a sessão
}


session_destroy();// Destroy a sessão

// Redirect to login page
header("Location: paglogin.html"); // Redireciona para pagina login

