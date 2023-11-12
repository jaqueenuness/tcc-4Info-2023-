<?php include('partials-front/menu.php'); ?>

<!-- Seção de Pesquisa de Comida Começa Aqui -->
<section class="food-search text-center">
    <div class="container">
        <?php 

            // Obtenha a Palavra-chave de Pesquisa
            $search = mysqli_real_escape_string($conn, $_POST['search']);
        
        ?>


        <h2>Pratos na sua Pesquisa <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

    </div>
</section>
<!-- Seção de Pesquisa de Comida Termina Aqui -->

<!-- Seção do Menu de Comida Começa Aqui -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Menu de Comida</h2>

        <?php 

            // Consulta SQL para obter alimentos com base na palavra-chave de pesquisa
            $sql = "SELECT * FROM tbl_comida WHERE titulo LIKE '%$search%' OR descrição LIKE '%$search%'";

            // Execute a Consulta
            $res = mysqli_query($conn, $sql);

            // Contagem de Linhas
            $count = mysqli_num_rows($res);

            // Verifique se há comida disponível ou não
            if($count > 0)
            {
                // Comida Disponível
                while($row = mysqli_fetch_assoc($res))
                {
                    // Obtenha os detalhes
                    $id = $row['id'];
                    $titulo = $row['titulo'];
                    $preço = $row['preço'];
                    $descrição = $row['descrição'];
                    $nome_imagem = $row['nome_imagem'];
                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                                // Verifique se o nome da imagem está disponível ou não
                                if($nome_imagem == "")
                                {
                                    // Imagem não disponível
                                    echo "<div class='error'>Imagem não disponível.</div>";
                                }
                                else
                                {
                                    // Imagem disponível
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $nome_imagem; ?>" alt="Pizza Havaiana de Frango" class="img-responsive img-curve">
                                    <?php 

                                }
                            ?>
                            
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $titulo; ?></h4>
                            <p class="food-preço">$<?php echo $preço; ?></p>
                            <p class="food-detail">
                                <?php echo $descrição; ?>
                            </p>
                            <br>

                            <a href="#" class="btn btn-primary">Faça seu Pedido Agora</a>
                        </div>
                    </div>

                    <?php
                }
            }
            else
            {
                // Comida Não Disponível
                echo "<div class='error'>Comida não encontrada.</div>";
            }
        
        ?>

        <div class="clearfix"></div>

    </div>

</section>
<!-- Seção do Menu de Comida Termina Aqui -->


