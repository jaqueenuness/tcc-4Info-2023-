<?php
// Inclua o arquivo de constantes e a conexão com o banco de dados
include('../config/constants.php');


// Verifique se o ID e o nome da imagem estão definidos
if (isset($_GET['id']) && isset($_GET['nome_imagem'])) {
    // Obtenha o valor e exclua
    $id = $_GET['id'];
    $nome_imagem = $_GET['nome_imagem'];

    // Remova o arquivo de imagem física, se disponível
    if ($nome_imagem != "") {
        // O caminho para a pasta de imagens
        $caminho = "../images/categoria/" . $nome_imagem;

        // Verifique se a imagem está disponível antes de tentar removê-la
        if (file_exists($caminho)) {
            // Remova o arquivo de imagem da pasta
            $remover = unlink($caminho);

            // Verifique se a imagem foi removida com sucesso
            if (!$remover) {
                // Falha ao remover a imagem
                $_SESSION['remove'] = "<div class='error'>Falha ao remover a imagem da categoria.</div>";
                // Redirecione para a página Gerenciar Categoria
                header('location:' . SITEURL . 'admin/gerenciar-categoria.php');
                // Interrompa o processo
                die();
            }
        }
    }

    // Excluir dados do banco de dados
    // Consulta SQL para excluir dados do banco de dados
    $sql = "DELETE FROM tbl_categoria WHERE id=$id";

    // Execute a consulta
    $res = mysqli_query($conn, $sql);

    // Verifique se os dados foram excluídos do banco de dados ou não
    if ($res) {
        // Defina a mensagem de sucesso e redirecione
        $_SESSION['delete'] = "<div class='success'>Categoria excluída com sucesso.</div>";
        // Redirecione para Gerenciar Categoria
        header('location:' . SITEURL . 'admin/gerenciar-categoria.php');
    } else {
        // A consulta SQL falhou, adicione um log ou mensagem de erro
        $_SESSION['delete'] = "<div class='error'>Falha ao excluir a categoria.</div>";
        // Redirecione para Gerenciar Categoria
        header('location:' . SITEURL . 'admin/gerenciar-categoria.php');
    }
} else {
    // Redirecione para a página Gerenciar Categoria
    header('location:' . SITEURL . 'admin/gerenciar-categoria.php');
}
?>
