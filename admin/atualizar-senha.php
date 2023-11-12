<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div a="wrapper">
        <h1>Alterar Senha</h1>
        <br><br>

        <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST">
        
            <table class="tbl-30">
                <tr>
                    <td>Senha Atual: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Senha Atual">
                    </td>
                </tr>

                <tr>
                    <td>Nova Senha:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="Nova Senha">
                    </td>
                </tr>

                <tr>
                    <td>Confirmar Senha: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirmar Senha">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Alterar Senha" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>

<?php 

    // Verifique se o botão Enviar foi clicado
    if(isset($_POST['submit']))
    {
        // Obtenha os dados do formulário
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        // Verifique se o usuário com o ID atual e a Senha Atual existe
        $sql = "SELECT * FROM tbl_administrador WHERE id=$id AND senha='$current_password'";
        $res = mysqli_query($conn, $sql);

        if($res == true)
        {
            // Verifique se os dados estão disponíveis
            $count = mysqli_num_rows($res);

            if($count == 1)
            {
                // O usuário existe e a Senha pode ser alterada

                // Verifique se a Nova Senha e a Confirmação coincidem
                if($new_password == $confirm_password)
                {
                    // Atualize a Senha
                    $sql2 = "UPDATE tbl_administrador SET senha='$new_password' WHERE id=$id";
                    $res2 = mysqli_query($conn, $sql2);

                    if($res2 == true)
                    {
                        // Exiba uma mensagem de sucesso e redirecione para a página de Gerenciar Administradores
                        $_SESSION['change-pwd'] = "<div class='success'>Senha Alterada com Sucesso. </div>";
                        header('location:'.SITEURL.'admin/gerenciar-administrador.php');
                    }
                    else
                    {
                        // Exiba uma mensagem de erro e redirecione para a página de Gerenciar Administradores
                        $_SESSION['change-pwd'] = "<div class='error'>Falha ao Alterar a Senha. </div>";
                        header('location:'.SITEURL.'admin/gerenciar-administrador.php');
                    }
                }
                else
                {
                    // Redirecione para a página de Gerenciar Administradores com uma mensagem de erro
                    $_SESSION['pwd-not-match'] = "<div class='error'>Senhas não Conferem. </div>";
                    header('location:'.SITEURL.'admin/gerenciar-administrador.php');
                }
            }
            else
            {
                // O usuário não existe, defina uma mensagem de erro e redirecione
                $_SESSION['user-not-found'] = "<div class='error'>Usuário não Encontrado. </div>";
                header('location:'.SITEURL.'admin/gerenciar-administrador.php');
            }
        }
    }
?>
