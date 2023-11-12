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

<!-- Seção de Menu de Alimentos Começa Aqui -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Cardápio</h2>

        <?php 
            // Exibir Alimentos que estão Ativos
            $sql = "SELECT * FROM tbl_comida WHERE ativo='Sim'";

            // Executar a Consulta
            $res = mysqli_query($conn, $sql);

            // Contar as Linhas
            $count = mysqli_num_rows($res);

            // Verificar se os alimentos estão disponíveis ou não
            if ($count > 0) {
                // Alimentos Disponíveis
                while ($row = mysqli_fetch_assoc($res)) {
                    // Obter os Valores
                    $id = $row['id'];
                    $titulo = $row['titulo'];
                    $descrição = $row['descrição'];
                    $preço = $row['preço'];
                    $nome_imagem = $row['nome_imagem'];
                    ?>
                    
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                                // Verificar se a imagem está disponível ou não
                                if ($nome_imagem == "") {
                                    // Imagem não disponível
                                    echo "<div class='error'>Imagem não disponível.</div>";
                                } else {
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
            } else {
                // Alimento não disponível
                echo "<div class='error'>Alimento não encontrado.</div>";
            }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Seção de Menu de Alimentos Termina Aqui -->
