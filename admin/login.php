<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Sistema de Pedidos de Comida</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>

            <!-- Formulário de Login Começa Aqui -->
            <form action="" method="POST" class="text-center">
            Nome de Usuário: <br>
            <input type="text" name="username" placeholder="Digite o Nome de Usuário"><br><br>

            Senha: <br>
            <input type="password" name="password" placeholder="Digite a Senha"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
            </form>
            <!-- Formulário de Login Termina Aqui -->


        </div>

    </body>
</html>

<?php 

    // Verifique se o botão de envio foi clicado
    if(isset($_POST['submit']))
    {
        // Processamento do Login
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);

        // SQL para verificar se o usuário com nome de usuário e senha existe ou não
        $sql = "SELECT * FROM tbl_administrador WHERE nome_de_usuario='$username' AND senha='$password'";

        // Execute a consulta
        $res = mysqli_query($conn, $sql);

        // Conte as linhas para verificar se o usuário existe ou não
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            // Usuário disponível e Login bem-sucedido
            $_SESSION['login'] = "<div class='success'>Login bem-sucedido.</div>";
            $_SESSION['user'] = $username; // Para verificar se o usuário está logado e o logout irá desativá-lo

            // Redirecione para a Página Inicial/Painel
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            // Usuário não disponível e Login falhou
            $_SESSION['login'] = "<div class='error text-center'>Nome de usuário ou senha não corresponde.</div>";
            // Redirecione para a Página Inicial/Painel
            header('location:'.SITEURL.'admin/login.php');
        }
    }

?>
