<?php

// Include database connection
include_once '../model/conexao.php';

// Get form data
$id = filter_input(INPUT_POST, 'id');
$nome = filter_input(INPUT_POST, 'nome');
$usuario = filter_input(INPUT_POST, 'usuario');
$senha = filter_input(INPUT_POST, 'senha_usuario'); // Get the new password
$tipo = filter_input(INPUT_POST, 'tipo');

// echo "$id <br>";
// echo "$nome <br>";
// echo "$usuario <br>";
// echo "$senha <br>";
// echo "$tipo <br>";

// die;


// Hash the new password for security
$hashedPassword = password_hash($senha, PASSWORD_DEFAULT);

// Validate input data (optional)
// ... (add your validation logic here)

// Attempt to update user data
if (isset($id) && isset($nome) && isset($usuario) && isset($senha) && isset($tipo)) {
  try {
    // Prepare query to update user details
    $query = "UPDATE usuarios SET nome = :nome, usuario = :usuario, senha_usuario = :senha, tipo = :tipo WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->bindParam(':id', $id);
    $statement->bindParam(':nome', $nome);
    $statement->bindParam(':usuario', $usuario);
    $statement->bindParam(':senha', $hashedPassword); // Bind the hashed password
    $statement->bindParam(':tipo', $tipo);

    if ($statement->execute()) {
      echo "Usuário atualizado com sucesso!";
    } else {
      echo "Falha ao atualizar o usuário. Tente novamente.";
    }
  } catch (PDOException $e) {
    echo "Erro no banco de dados: " . $e->getMessage();
  }
} else {
  echo "Dados inválidos.";
}

?>