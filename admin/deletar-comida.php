<?php
include('../config/constants.php');

if (isset($_GET['id']) && isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if ($image_name != "") {
        $path = "../images/food/" . $image_name;

        // Verifique se o arquivo de imagem existe e remova-o
        if (file_exists($path)) {
            $removed = unlink($path);

            if ($removed) {
                echo "Arquivo removido com sucesso.<br>";
            } else {
                echo "Falha ao remover o arquivo de imagem.<br>";
            }
        } else {
            echo "O arquivo de imagem não foi encontrado no caminho especificado.<br>";
        }
    }

    $sql = "DELETE FROM tbl_comida WHERE id = $id";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'>Alimento Excluído com Sucesso.</div>";
        header('location:' . SITEURL . 'admin/gerenciar-comida.php');
    } else {
        $_SESSION['delete'] = "<div class='error'>Falha ao Excluir o Alimento.</div>";
        header('location:' . SITEURL . 'admin/gerenciar-comida.php');
    }
} else {
    $_SESSION['unauthorized'] = "<div class='error'>Acesso não autorizado.</div>";
    header('location:' . SITEURL . 'admin/gerenciar-comida.php');
}
?>
