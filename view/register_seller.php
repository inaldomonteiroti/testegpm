<?php

// Include database connection
include_once '../model/conexao.php';


// Pegar os dados do formulário
$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha');
$tipo = filter_input(INPUT_POST, 'tipo');

// Criptografar senha por segurança
$hashedPassword = password_hash($senha, PASSWORD_DEFAULT);

// Preparar e executar a query para inserir os dados
$query = "INSERT INTO usuarios (nome, usuario, senha_usuario, tipo) VALUES (:nome, :usuario, :senha, :tipo)";
$statement = $conn->prepare($query);
$statement->bindParam(':nome', $nome);
$statement->bindParam(':usuario', $email);
$statement->bindParam(':tipo', $tipo);
$statement->bindParam(':senha', $hashedPassword);

if ($statement->execute()) {
    echo "Vendedor registrado com sucesso!";
} else {
    echo "Falha ao registrar o vendedor. Tente novamente.";
}