<?php

// Include database connection
include_once '../model/conexao.php';

// Initialize variables
$registroMensagem = "";

// Pegar os dados do formulário
$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha');
$tipo = filter_input(INPUT_POST, 'tipo');

// Criptografar senha por segurança
$hashedPassword = password_hash($senha, PASSWORD_DEFAULT);


if (isset($_POST['nome']) && isset($_POST['usuario']) && isset($_POST['senha']) && isset($_POST['tipo'])) {
    try {
// Preparar e executar a query para inserir os dados
$query = "INSERT INTO usuarios (nome, usuario, senha_usuario, tipo) VALUES (:nome, :usuario, :senha, :tipo)";
$statement = $conn->prepare($query);
$statement->bindParam(':nome', $nome);
$statement->bindParam(':usuario', $email);
$statement->bindParam(':tipo', $tipo);
$statement->bindParam(':senha', $hashedPassword);

if ($statement->execute()) {
    $registroMensagem  = "Vendedor registrado com sucesso!";
} else {
    $registroMensagem  = "Falha ao registrar o vendedor. Tente novamente.";
}
} catch (PDOException $e) {
    $registroMensagem  = "Erro no banco de dados: " . $e->getMessage();
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SYSMAC - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Cadastro de Vendedores!</h1>
                            </div>
                            <form class="user" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="nome" name="nome"
                                            placeholder="Nome" required>
                                    </div>                                   
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="usuario" name="usuario" required
                                        placeholder="Email">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                        id="senha" name="senha" required  placeholder="Senha">
                                    </div>
                                    
                                </div>
                                <input type="hidden" id="tipo" name="tipo" value="vendedor">
                                <button class="btn btn-primary btn-user btn-block" type="submit">Cadastrar</button>
                                                            
                            </form>
                            <hr>
                            <?php if ($registroMensagem  != "") : ?>
        <p style="color: <?php echo ($registroMensagem  == "Vendedor registrado com sucesso!" ? "green" : "red"); ?>;"><?php echo $registroMensagem ; ?></p>
    <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>