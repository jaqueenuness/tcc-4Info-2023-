<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Adicionar Comida</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
        
            <table class="tbl-30">

                <tr>
                    <td>Título: </td>
                    <td>
                        <input type="text" name="title" placeholder="Título da Comida">
                    </td>
                </tr>

                <tr>
                    <td>Descrição: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Descrição da Comida"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Preço: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Selecionar Imagem: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Categoria: </td>
                    <td>
                        <select name="category">
                            <?php 
                                $sql = "SELECT * FROM tbl_categoria WHERE ativo='Sim'";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);

                                if($count > 0)
                                {
                                    while($row = mysqli_fetch_assoc($res))
                                    {
                                        $id = $row['id'];
                                        $title = $row['titulo'];
                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <option value="0">Nenhuma Categoria Encontrada</option>
                                    <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Destaque: </td>
                    <td>
                        <input type="radio" name="featured" value="Sim"> Sim 
                        <input type="radio" name="featured" value="Não"> Não
                    </td>
                </tr>

                <tr>
                    <td>Ativo: </td>
                    <td>
                        <input type="radio" name="active" value="Sim"> Sim 
                        <input type="radio" name="active" value="Não"> Não
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Adicionar Comida" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        
        <?php 
            if(isset($_POST['submit']))
            {
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "Não";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "Não";
                }

                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];
                    if($image_name != "")
                    {
                        $ext = end(explode('.', $image_name));
                        $image_name = "Nome-Comida-" . rand(0000, 9999) . "." . $ext;
                        $src = $_FILES['image']['tmp_name'];
                        $dst = "../images/food/" . $image_name;
                        $upload = move_uploaded_file($src, $dst);

                        if($upload == false)
                        {
                            $_SESSION['upload'] = "<div class='error'>Falha ao fazer o upload da imagem.</div>";
                            header('location:'.SITEURL.'admin/add-comida.php');
                            die();
                        }
                    }
                }
                else
                {
                    $image_name = "";
                }

                $sql2 = "INSERT INTO tbl_comida (titulo, descrição, preço, nome_imagem, id_categoria, destacado, ativo) VALUES 
                ('$title', '$description', '$price', '$image_name', '$category', '$featured', '$active')";

                $res2 = mysqli_query($conn, $sql2);

                if($res2 == true)
                {
                    $_SESSION['add'] = "<div class='success'>Comida Adicionada com Sucesso.</div>";
                    header('location:'.SITEURL.'admin/gerenciar-comida.php');
                }
                else
                {
                    $_SESSION['add'] = "<div class='error'>Falha ao Adicionar Comida.</div>";
                    header('location:'.SITEURL.'admin/add-comida.php');
                }
            }
        ?>
    </div>
</div>
