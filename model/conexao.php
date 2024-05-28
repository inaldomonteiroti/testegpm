<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "sysmac";
$port = 3306;

try {
    $conn = new PDO("mysql:host=$host;port=$port; dbname=" . $dbname, $user, $pass);
     echo "Conexao realizada com sucesso";
} catch(PDOException $err) {
     echo "Conexão com o banco de dados realizado com sucesso " . $err->getMessage();
}