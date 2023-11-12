<?php include('partials-front/menu.php'); ?>

<?php 
    // Verifica se o ID da categoria foi passado ou não
    if(isset($_GET['category_id']))
    {
        // ID da categoria foi definido, então obtenha o ID
        $category_id = $_GET['category_id'];
        // Obtenha o Título da Categoria com base no ID da Categoria
        $sql = "SELECT titulo FROM tbl_categoria WHERE id = $category_id";

        // Execute a consulta
        $res = mysqli_query($conn, $sql);

        // Obtenha o valor do Banco de Dados
        $row = mysqli_fetch_assoc($res);
        // Obtenha o Título
        $category_title = $row['titulo'];
    }
    else
    {
        // Categoria não passada
        // Redireciona para a página inicial
        header('location:' . SITEURL);
    }
?>

<!-- Seção de Pesquisa de Comida Começa Aqui -->
<section class="food-search text-center">
    <div class="container">
        
        <h2>Pratos em <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

    </div>
</section>
<!-- Seção de Pesquisa de Comida Termina Aqui -->

<!-- Seção do Menu de Comida Começa Aqui -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Menu de Comida</h2>

        <?php 

            // Crie uma consulta SQL para obter alimentos com base na Categoria Selecionada
            $sql2 = "SELECT * FROM tbl_comida WHERE id_categoria = $category_id";

            // Execute a consulta
            $res2 = mysqli_query($conn, $sql2);

            // Contagem de Linhas
            $count2 = mysqli_num_rows($res2);

            // Verifique se há comida disponível ou não
            if($count2 > 0)
            {
                // Comida Disponível
                while($row2 = mysqli_fetch_assoc($res2))
                {
                    $id = $row2['id'];
                    $titulo = $row2['titulo'];
                    $preço = $row2['preço'];
                    $descrição = $row2['descrição'];
                    $nome_imagem = $row2['nome_imagem'];
                    ?>
                    
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                                if($nome_imagem == "")
                                {
                                    // Imagem não Disponível
                                    echo "<div class='error'>Imagem não Disponível.</div>";
                                }
                                else
                                {
                                    // Imagem Disponível
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $nome_imagem; ?>" alt="Pizza Hawaiana de Frango" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $titulo; ?></h4>
                            <p class="food-price">R$<?php echo $preço; ?></p>
                            <p class="food-detail">
                                <?php echo $descrição; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Faça seu Pedido Agora</a>
                        </div>
                    </div>

                    <?php
                }
            }
            else
            {
                // Comida não disponível
                echo "<div class='error'>Comida não Disponível.</div>";
            }
        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- Seção do Menu de Comida Termina Aqui -->

