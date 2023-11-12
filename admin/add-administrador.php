<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Adicionar Administrador</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add'])) // Verifica se a Sessão está definida ou não
            {
                echo $_SESSION['add']; // Exibe a mensagem da Sessão se estiver definida
                unset($_SESSION['add']); // Remove a mensagem da Sessão
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Nome Completo: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Digite seu Nome">
                    </td>
                </tr>

                <tr>
                    <td>Nome de Usuário: </td>
                    <td>
                        <input type="text" name= "username" placeholder="Seu Nome de Usuário">
                    </td>
                </tr>

                <tr>
                    <td>Senha: </td>
                    <td>
                        <input type="password" name="password" placeholder="Sua Senha">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Adicionar Administrador" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>

<?php 
    // Processar os valores do formulário e salvá-los no banco de dados

    // Verificar se o botão de envio foi clicado ou não

    if(isset($_POST['submit']))
    {
        // Botão clicado
        // echo "Botão Clicado";

        // 1. Obter os dados do formulário
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); // Criptografia de senha com MD5

        // 2. Consulta SQL para salvar os dados no banco de dados
        $sql = "INSERT INTO tbl_administrador SET 
            nome_completo='$full_name',
            nome_de_usuario='$username',
            senha='$password'
        ";
 
        // 3. Executar a consulta e salvar os dados no banco de dados
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // 4. Verificar se a consulta foi executada e exibir a mensagem apropriada
        if($res == TRUE)
        {
            // Dados Inseridos
            // echo "Dados Inseridos";
            // Criar uma Variável de Sessão para Exibir a Mensagem
            $_SESSION['add'] = "<div class='success'>Administrador Adicionado com Sucesso.</div>";
            // Redirecionar para a Página de Gerenciamento de Administradores
            header("location:".SITEURL.'admin/gerenciar-administrador.php');
        }
        else
        {
            // Falha ao Inserir os Dados
            // echo "Falha ao Inserir os Dados";
            // Criar uma Variável de Sessão para Exibir a Mensagem
            $_SESSION['add'] = "<div class='error'>Falha ao Adicionar o Administrador.</div>";
            // Redirecionar para a Página de Adicionar Administrador
            header("location:".SITEURL.'admin/add-administrador.php');
        }
    }
?>
