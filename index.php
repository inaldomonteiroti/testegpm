<?php
    session_start();
    ob_start(); // limpar buffer
    include_once './model/conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SYSMAC Login</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>

    <?php
        // Exemplo criptografar a senha
        // echo password_hash(123456, PASSWORD_DEFAULT);
    ?>

    <?php
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT );        

        if(!empty($dados['EnviaLogin'])){
            // var_dump($dados);
            $query_usuario = "SELECT id, nome, usuario, senha_usuario 
                              FROM usuarios 
                              WHERE usuario = :usuario
                              LIMIT 1";

            $result_usuario = $conn->prepare($query_usuario);
            $result_usuario->bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR); //link forçar para ser string
            $result_usuario->execute();

            if(($result_usuario) AND ($result_usuario -> rowCount() !=0)){
                $row_usuario =  $result_usuario->fetch(PDO::FETCH_ASSOC);

                    // var_dump($row_usuario);
                    if(password_verify($dados['senha_usuario'], $row_usuario['senha_usuario'])){
                        $_SESSION['id'] = $row_usuario['id'];
                        $_SESSION['nome'] = $row_usuario['nome'];
                        header("Location: ./view/index.php");
                    }else{
                        $_SESSION['msg'] = " <p style='color:red'>Erro: Usuário ou senha inválida ! </p> ";
                    }
            }else{
                $_SESSION['msg'] = " <p style='color:red'>Erro: Usuário ou senha inválida ! </p> ";
            }
            
        }

        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
    ?>
    
    <div class="page">
        
        <form id="formulario" method="POST" class="formLogin" action="">
            <h2 class="titulo">SYSMAC</h2>
            <p>Digite os seus dados de acesso no campo abaixo.</p>
            <label for="usuario">Usuário</label>
            <input type="usuario" name="usuario" placeholder="Digite seu usuario" value="<?php if(isset($dados['usuario'])){ echo $dados['usuario'];} ?>" autofocus="true" />
            <label for="senha">Senha</label>
            <input type="password" name="senha_usuario" placeholder="Digite sua senha" value="<?php if(isset($dados['senha_usuario'])){ echo $dados['senha_usuario'];} ?>" />
            <!-- <div> <a class="esqueci" href="/">Esqueci minha senha</a><a class="cadastrar" href="/">Efetue um cadastro</a></div>            -->
            <input type="submit" value="Acessar" class="btn" name="EnviaLogin" />
        </form>
    </div>    
</body>
</html>