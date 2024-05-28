<?php 
session_start();
ob_start();
unset($_SESSION['id'], $_SESSION['nome'] );
$_SESSION['msg'] = " <p style='color:green; text-align:center;'> Usuário deslogado com sucesso ! </p> ";
header("Location: ../");