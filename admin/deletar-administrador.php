<?php
    // Inclua o arquivo constants.php aqui
    include('../config/constants.php');

    // 1. Obtenha o ID do administrador a ser excluído
    $id = $_GET['id'];

    // 2. Crie uma consulta SQL para excluir o administrador
    $sql = "DELETE FROM tbl_administrador WHERE id=$id";

    // Execute a consulta
    $res = mysqli_query($conn, $sql);

    // Verifique se a consulta foi executada com sucesso ou não
    if ($res == true) {
        // Consulta executada com sucesso e o administrador foi excluído
        // Crie uma variável de sessão para exibir a mensagem
        $_SESSION['delete'] = "<div class='success'>Admin Excluído com Sucesso.</div>";
        // Redirecione para a página Gerenciar Administradores
        header('location:' . SITEURL . 'admin/gerenciar-administrador.php');
    } else {
        // Falha ao excluir o administrador
        $_SESSION['delete'] = "<div class='error'>Falha ao excluir o administrador. Tente novamente mais tarde.</div>";
        header('location:' . SITEURL . 'admin/gerenciar-administrador.php');
    }

    // 3. Redirecione para a página Gerenciar Administradores com a mensagem (sucesso/erro)
?>
