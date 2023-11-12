<?php include('partials/menu.php'); ?>

<?php 
    // Verifique se o ID está definido ou não
    if(isset($_GET['id']))
    {
        // Obtenha todos os detalhes
        $id = $_GET['id'];

        // Consulta SQL para obter a comida selecionada
        $sql2 = "SELECT * FROM tbl_comida WHERE id=$id";
        // Execute a consulta
        $res2 = mysqli_query($conn, $sql2);

        // Obtenha os valores com base na consulta executada
        $row2 = mysqli_fetch_assoc($res2);

        // Obtenha os valores individuais da comida selecionada
        $title = $row2['titulo'];
        $description = $row2['descrição'];
        $price = $row2['preço'];
        $current_image = $row2['nome_imagem'];
        $current_category = $row2['id_categoria'];
        $featured = $row2['destacado'];
        $active = $row2['ativo'];

    }
    else
    {
        // Redirecione para Gerenciar Comida
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Atualizar Comida</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
        
        <table class="tbl-30">

            <tr>
                <td>Título: </td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>

            <tr>
                <td>Descrição: </td>
                <td>
                    <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                </td>
            </tr>

            <tr>
                <td>Preço: </td>
                <td>
                    <input type="number" name="price" value="<?php echo $price; ?>">
                </td>
            </tr>

            <tr>
                <td>Imagem Atual: </td>
                <td>
                    <?php 
                        if($current_image == "")
                        {
                            // Imagem não disponível
                            echo "<div class='error'>Imagem não disponível.</div>";
                        }
                        else
                        {
                            // Imagem disponível
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
                            <?php
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <td>Selecione uma Nova Imagem: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Categoria: </td>
                <td>
                    <select name="category">

                        <?php 
                            // Consulta para Obter Categorias Ativas
                            $sql = "SELECT * FROM tbl_categoria WHERE ativo='Sim'";
                            // Execute a consulta
                            $res = mysqli_query($conn, $sql);
                            // Contagem de linhas
                            $count = mysqli_num_rows($res);

                            // Verifique se a categoria está disponível ou não
                            if($count>0)
                            {
                                // Categoria disponível
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $category_title = $row['titulo'];
                                    $category_id = $row['id'];
                                    
                                    //echo "<option value='$category_id'>$category_title</option>";
                                    ?>
                                    <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                // Categoria não disponível
                                echo "<option value='0'>Categoria não disponível.</option>";
                            }

                        ?>

                    </select>
                </td>
            </tr>

            <tr>
                <td>Destaque: </td>
                <td>
                    <input <?php if($featured=="Sim") {echo "checked";} ?> type="radio" name="featured" value="Sim"> Sim 
                    <input <?php if($featured=="Não") {echo "checked";} ?> type="radio" name="featured" value="Não"> Não 
                </td>
            </tr>

            <tr>
                <td>Ativo: </td>
                <td>
                    <input <?php if($active=="Sim") {echo "checked";} ?> type="radio" name="active" value="Sim"> Sim 
                    <input <?php if($active=="Não") {echo "checked";} ?> type="radio" name="active" value="Não"> Não 
                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="submit" name="submit" value="Atualizar Comida" class="btn-secondary">
                </td>
            </tr>
        </table>
        </form>

        <?php 
        
            if(isset($_POST['submit']))
            {
                //1. Obtenha todos os detalhes do formulário
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];

                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2. Faça o upload da imagem, se selecionada

                // Verifique se o botão de upload foi clicado ou não
                if(isset($_FILES['image']['name']))
                {
                    // Botão de Upload Clicado
                    $image_name = $_FILES['image']['name']; // Novo Nome da Imagem

                    // Verifique se o arquivo está disponível ou não
                    if($image_name!="")
                    {
                        // Imagem está disponível
                        // A. Enviando Nova Imagem

                        // Renomeie a imagem
                        $ext = end(explode('.', $image_name)); // Obtém a extensão da imagem

                        $image_name = "Food-Name-".rand(0000, 9999).'.'.$ext; // Este será o nome da imagem renomeada

                        // Obtenha o Caminho de Origem e o Caminho de Destino
                        $src_path = $_FILES['image']['tmp_name']; // Caminho de Origem
                        $dest_path = "../images/food/".$image_name; // Caminho de Destino

                        // Faça o upload da imagem
                        $upload = move_uploaded_file($src_path, $dest_path);

                        // Verifique se a imagem foi enviada ou não
                        if($upload==false)
                        {
                            // Falha ao fazer o upload
                            $_SESSION['upload'] = "<div class='error'>Falha ao fazer o upload da nova imagem.</div>";
                            // Redirecione para Gerenciar Comida 
                            header('location:'.SITEURL.'admin/manage-food.php');
                            // Pare o processo
                            die();
                        }

                        //3. Remova a imagem se uma nova imagem for enviada e a imagem atual existir
                        // B. Remova a imagem atual se estiver disponível
                        if($current_image!="")
                        {
                            // A imagem atual está disponível
                            // Remova a imagem
                            $remove_path = "../images/food/".$current_image;

                            $remove = unlink($remove_path);

                            // Verifique se a imagem foi removida ou não
                            if($remove==false)
                            {
                                // Falha ao remover a imagem atual
                                $_SESSION['remove-failed'] = "<div class='error'>Falha ao remover a imagem atual.</div>";
                                // Redirecione para Gerenciar Comida
                                header('location:'.SITEURL.'admin/manage-food.php');
                                // Pare o processo
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name = $current_image; // Imagem Padrão quando a Imagem não é Selecionada
                    }
                }
                else
                {
                    $image_name = $current_image; // Imagem Padrão quando o Botão não é Clicado
                }

                //4. Atualize a Comida no Banco de Dados
                $sql3 = "UPDATE tbl_comida SET 
                    titulo = '$title',
                    descrição = '$description',
                    preço = $price,
                    nome_imagem = '$image_name',
                    id_categoria = '$category',
                    destacado = '$featured',
                    ativo = '$active'
                    WHERE id=$id
                ";

                // Execute a Consulta SQL
                $res3 = mysqli_query($conn, $sql3);

                // Verifique se a consulta foi executada ou não
                if($res3==true)
                {
                    // Consulta executada e Comida Atualizada
                    $_SESSION['update'] = "<div class='success'>Comida Atualizada com Sucesso.</div>";
                    header('location:'.SITEURL.'admin/gerenciar-comida.php');
                }
                else
                {
                    // Falha ao Atualizar a Comida
                    $_SESSION['update'] = "<div class='error'>Falha ao Atualizar a Comida.</div>";
                    header('location:'.SITEURL.'admin/gerenciar-comida.php');
                }
            }
        ?>
    </div>
</div>
