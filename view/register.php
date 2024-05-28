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


<?php
    session_start();
    ob_start(); // limpar buffer
    include_once '../model/conexao.php';

    if ((!isset($_SESSION['id'])) AND (!isset($_SESSION['nome']))){
        header("Location: index.php");
        $_SESSION['msg'] = " <p style='color:red'> Página restrita ! </p> ";
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

    <title>SYSMAC - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SYSMAC<sup>ADMIN</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Vendedores</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Vendedores</h6> -->
                        <a class="collapse-item" href="register.php">Cadastro de Vendedores</a>
                    </div>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Vendedores</h6> -->
                        <a class="collapse-item" href="listar.php">Listar Vendedores</a>
                    </div>
                </div>
            </li>
            

                       
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

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

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

       <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>