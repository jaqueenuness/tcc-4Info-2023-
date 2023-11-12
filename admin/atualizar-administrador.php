<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Atualizar Administrador</h1>

        <br><br>

        <?php 
            // 1. Obter o ID do Administrador Selecionado
            $id = $_GET['id'];

            // 2. Criar a consulta SQL para obter os detalhes
            $sql = "SELECT * FROM tbl_administrador WHERE id = $id";

            // Executar a consulta
            $res = mysqli_query($conn, $sql);

            // Verificar se a consulta foi executada com sucesso
            if ($res == true) {
                // Verifique se os dados estão disponíveis
                $count = mysqli_num_rows($res);

                // Verifique se temos dados de administrador ou não
                if ($count == 1) {
                    // Obter os detalhes
                    $row = mysqli_fetch_assoc($res);

                    $nome_completo = $row['nome_completo'];
                    $nome_de_usuario = $row['nome_de_usuario'];
                } else {
                    // Redirecione para a página de Gerenciar Administradores
                    header('location:' . SITEURL . 'admin/administrador-.php');
                }
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Nome Completo: </td>
                    <td>
                        <input type="text" name="nome_completo" value="<?php echo $nome_completo; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Nome de Usuário: </td>
                    <td>
                        <input type="text" name="nome_de_usuario" value="<?php echo $nome_de_usuario; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Atualizar Administrador" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>

<?php 

    // Verifique se o botão Enviar foi clicado
    if (isset($_POST['submit'])) {
        // Obter todos os valores do formulário para atualizar
        $id = $_POST['id'];
        $nome_completo = $_POST['nome_completo'];
        $nome_de_usuario = $_POST['nome_de_usuario'];

        // Crie uma consulta SQL para atualizar o Administrador
        $sql = "UPDATE tbl_administrador SET
        nome_completo = '$nome_completo',
        nome_de_usuario = '$nome_de_usuario' 
        WHERE id = '$id'
        ";

        // Executar a consulta
        $res = mysqli_query($conn, $sql);

        // Verifique se a consulta foi executada com sucesso
        if ($res == true) {
            // Consulta executada e Administrador atualizado
            $_SESSION['update'] = "<div class='success'>Administrador Atualizado com Sucesso.</div>";
            // Redirecione para a página de Gerenciar Administradores
            header('location:' . SITEURL . 'admin/gerenciar-administrador.php');
        } else {
            // Falha ao Atualizar o Admin
            $_SESSION['update'] = "<div class='error'>Falha ao Atualizar o Administrador.</div>";
            // Redirecione para a página de Gerenciar Administradores
            header('location:' . SITEURL . 'admin/gerenciar-administrador.php');
        }
    }
?>
