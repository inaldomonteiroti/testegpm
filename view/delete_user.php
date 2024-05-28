<?php

// Incluir conexão database
include_once '../model/conexao.php';

// Pegar o usuário id dos parametros da URL
$id = filter_input(INPUT_GET, 'id');


// Attempt to delete user
if (isset($id) && $id > 0) {
  try {
    // Preparar consulta e excluir usuario a partir do ID
    $query = "DELETE FROM usuarios WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->bindParam(':id', $id);

    if ($statement->execute()) {
      echo "Usuário excluído com sucesso!";
    } else {
      echo "Falha ao excluir o usuário. Tente novamente.";
    }
  } catch (PDOException $e) {
    echo "Erro no banco de dados: " . $e->getMessage();
  }
} else {
  echo "ID de usuário inválido.";
}

?>