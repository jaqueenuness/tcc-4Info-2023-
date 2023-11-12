<?php include('partials-front/menu.php'); ?>

<!-- Seção de Pesquisa de Alimentos Começa Aqui -->
<section class="food-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Buscar por comida..." required>
            <input type="submit" name="submit" value="Buscar" class="btn btn-primary">
        </form>
    </div>
</section>
<!-- Seção de Pesquisa de Alimentos Termina Aqui -->

<?php 
    if(isset($_SESSION['order']))
    {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
?>

<!-- Seção de Categorias Começa Aqui -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explorar categorias</h2>

        <?php 
            // Crie uma consulta SQL para exibir categorias do banco de dados
            $sql = "SELECT * FROM tbl_categoria WHERE ativo='Sim' AND destacado='Sim' LIMIT 6";
            // Execute a consulta
            $res = mysqli_query($conn, $sql);
            // Contar as linhas para verificar se a categoria está disponível ou não
            $count = mysqli_num_rows($res);

            if($count > 0)
            {
                // Categorias disponíveis
                while($row = mysqli_fetch_assoc($res))
                {
                    // Obter os valores como id, título, Nãome da imagem
                    $id = $row['id'];
                    $titulo = $row['titulo'];
                    $nome_imagem = $row['nome_imagem'];
                    ?>
                    
                    <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php 
                                // Verificar se a imagem está disponível ou não
                                if($nome_imagem == "")
                                {
                                    // Exibir mensagem
                                    echo "<div class='error'>Imagem não disponível</div>";
                                }
                                else
                                {
                                    // Imagem disponível
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $nome_imagem; ?>" alt="<?php echo $titulo; ?>" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>

                            <h3 class="float-text text-white"><?php echo $titulo; ?></h3>
                        </div>
                    </a>
                    <?php
                }
            }
            else
            {
                // Categorias não disponíveis
                echo "<div class='error'>Categoria não adicionada.</div>";
            }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Seção de Categorias Termina Aqui -->

<!-- Seção do Menu de Alimentos Começa Aqui -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Menu de Destaque</h2>

        <?php 
        // Obtendo Alimentos do Banco de Dados que estão ativos e em destaque
        // Consulta SQL
        $sql2 = "SELECT * FROM tbl_comida WHERE ativo='Sim' AND destacado='Sim' LIMIT 10000";
        // Executar a Consulta
        $res2 = mysqli_query($conn, $sql2);
        // Contar as linhas
        $count2 = mysqli_num_rows($res2);

        if($count2 > 0)
        {
            // Alimentos Disponíveis
            while($row = mysqli_fetch_assoc($res2))
            {
                // Obter todos os valores
                $id = $row['id'];
                $titulo = $row['titulo'];
                $preço = $row['preço'];
                $descrição = $row['descrição'];
                $nome_imagem = $row['nome_imagem'];
                ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php 
                            // Verificar se a imagem está disponível ou não
                            if($nome_imagem == "")
                            {
                                // Imagem não disponível
                                echo "<div class='error'>Imagem não disponível.</div>";
                            }
                            else
                            {
                                // Imagem Disponível
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $nome_imagem; ?>" alt="<?php echo $titulo; ?>" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $titulo; ?></h4>
                        <p class="food-preço">R$<?php echo $preço; ?></p>
                        <p class="food-detail">
                            <?php echo $descrição; ?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Peça Agora</a>
                    </div>
                </div>
                <?php
            }
        }
        else
        {
            // Alimentos não disponíveis 
            echo "<div class='error'>Alimentos não disponíveis.</div>";
        }
        ?>
    </div>
    <p class="text-center">
        <a href="#">Ver Todos os Alimentos</a>
    </p>
</section>
<!-- Seção do Menu de Alimentos Termina Aqui -->
