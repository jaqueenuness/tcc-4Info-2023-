<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Atualizar Categoria</h1>

        <br><br>

        <?php 
        
            // Verifique se o ID está definido ou não
            if(isset($_GET['id']))
            {
                // Obtenha o ID e todos os outros detalhes
                $id = $_GET['id'];
                // Crie a consulta SQL para obter todos os outros detalhes
                $sql = "SELECT * FROM tbl_categoria WHERE id=$id";

                // Execute a consulta
                $res = mysqli_query($conn, $sql);

                // Conte as linhas para verificar se o ID é válido ou não
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    // Obtenha todos os dados
                    $row = mysqli_fetch_assoc($res);
                    $titulo = $row['titulo'];
                    $current_image = $row['nome_imagem'];
                    $destacado = $row['destacado'];
                    $ativo = $row['ativo'];
                }
                else
                {
                    // Redirecione para gerenciar categoria com mensagem de sessão
                    $_SESSION['no-categoria-found'] = "<div class='error'>Categoria não encontrada.</div>";
                    header('location:'.SITEURL.'admin/gerenciar-categoria.php');
                }
            }
            else
            {
                // Redirecione para Gerenciar Categoria
                header('location:'.SITEURL.'admin/gerenciar-categoria.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Título: </td>
                    <td>
                        <input type="text" name="titulo" value="<?php echo $titulo; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Imagem Atual: </td>
                    <td>
                        <?php 
                            if($current_image != "")
                            {
                                // Exibe a imagem
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                // Exibe a mensagem
                                echo "<div class='error'>Imagem não adicionada.</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Nova Imagem: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Destaque: </td>
                    <td>
                        <input <?php if($destacado=="Sim"){echo "checked";} ?> type="radio" name="destacado" value="Sim"> Sim 

                        <input <?php if($destacado=="No"){echo "checked";} ?> type= "radio" name="destacado" value="No"> Não 
                    </td>
                </tr>

                <tr>
                    <td>Ativa: </td>
                    <td>
                        <input <?php if($ativo=="Sim"){echo "checked";} ?> type="radio" name="ativo" value="Sim"> Sim 

                        <input <?php if($ativo=="No"){echo "checked";} ?> type="radio" name="ativo" value="No"> Não 
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Atualizar Categoria" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php 
        
            if(isset($_POST['submit']))
            {
                // 1. Obter todos os valores do nosso formulário
                $id = $_POST['id'];
                $titulo = $_POST['titulo'];
                $current_image = $_POST['current_image'];
                $destacado = $_POST['destacado'];
                $ativo = $_POST['ativo'];

                // 2. Atualizar Nova Imagem, se selecionada
                // Verifique se a imagem está selecionada ou não
                if(isset($_FILES['image']['name']))
                {
                    // Obtenha os detalhes da imagem
                    $nome_imagem = $_FILES['image']['name'];

                    // Verifique se a imagem está disponível ou não
                    if($nome_imagem != "")
                    {
                        // Imagem disponível

                        // A. Faça o upload da Nova Imagem

                        // Renomeie automaticamente nossa imagem
                        // Obtenha a extensão da nossa imagem (jpg, png, gif, etc), por exemplo, "specialfood1.jpg"
                        $ext = end(explode('.', $nome_imagem));

                        // Renomeie a imagem
                        $nome_imagem = "Food_categoria_".rand(000, 999).'.'.$ext; // por exemplo, Food_categoria_834.jpg

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$nome_imagem;

                        // Finalmente, faça o upload da imagem
                        $upload = move_uploaded_file($source_path, $destination_path);

                        // Verifique se a imagem foi carregada ou não
                        // E se a imagem não foi carregada, então vamos interromper o processo e redirecionar com mensagem de erro
                        if($upload==false)
                        {
                            // Defina a mensagem
                            $_SESSION['upload'] = "<div class='error'>Falha ao fazer o upload da imagem. </div>";
                            // Redirecione para a página de Gerenciar Categoria
                            header('location:'.SITEURL.'admin/gerenciar-categoria.php');
                            // Pare o Processo
                            die();
                        }

                        // B. Remova a Imagem Atual, se disponível
                        if($current_image!="")
                        {
                            $remove_path = "../images/category/".$current_image;

                            $remove = unlink($remove_path);

                            // Verifique se a imagem foi removida ou não
                            // Se falhar ao remover, exiba a mensagem e pare o processo
                            if($remove==false)
                            {
                                // Falha ao remover imagem
                                $_SESSION['failed-remove'] = "<div class='error'>Falha ao remover a imagem atual.</div>";
                                header('location:'.SITEURL.'admin/gerenciar-categoria.php');
                                die(); // Pare o Processo
                            }
                        }
                    }
                    else
                    {
                        $nome_imagem = $current_image;
                    }
                }
                else
                {
                    $nome_imagem = $current_image;
                }

                // 3. Atualize o Banco de Dados
                $sql2 = "UPDATE tbl_categoria SET 
                    titulo = '$titulo',
                    nome_imagem = '$nome_imagem',
                    destacado = '$destacado',
                    ativo = '$ativo' 
                    WHERE id=$id
                ";

                // Execute a Consulta
                $res2 = mysqli_query($conn, $sql2);

                // 4. Redirecione para Gerenciar Categoria com a Mensagem
                // Verifique se a consulta foi executada ou não
                if($res2==true)
                {
                    // Categoria Atualizada
                    $_SESSION['update'] = "<div class='success'>Categoria atualizada com sucesso.</div>";
                    header('location:'.SITEURL.'admin/gerenciar-categoria.php');
                }
                else
                {
                    // Falha ao atualizar a categoria
                    $_SESSION['update'] = "<div class='error'>Falha ao atualizar a categoria.</div>";
                    header('location:'.SITEURL.'admin/gerenciar-categoria.php');
                }
            }
        ?>

    </div>
</div>
