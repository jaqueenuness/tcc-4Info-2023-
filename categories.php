<?php include('partials-front/menu.php'); ?>

    <!-- Seção de Categorias Começa Aqui -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore as Categorias</h2>

            <?php 

                // Exibir todas as categorias que estão ativas
                // Consulta SQL
                $sql = "SELECT * FROM tbl_categoria WHERE ativo='Sim'";

                // Executar a consulta
                $res = mysqli_query($conn, $sql);

                // Contar as linhas
                $count = mysqli_num_rows($res);

                // Verificar se as categorias estão disponíveis ou não
                if ($count > 0) {
                    // Categorias Disponíveis
                    while ($row = mysqli_fetch_assoc($res)) {
                        // Obter os Valores
                        $id = $row['id'];
                        $titulo = $row['titulo'];
                        $nome_imagem = $row['nome_imagem'];
                        ?>
                        
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    if ($nome_imagem == "") {
                                        // Imagem não disponível
                                        echo "<div class='error'>Imagem não encontrada.</div>";
                                    } else {
                                        // Imagem Disponível
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $nome_imagem; ?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                <h3 class="float-text text-white"><?php echo $titulo; ?></h3>
                            </div>
                        </a>

                        <?php
                    }
                } else {
                    // Categorias não disponíveis
                    echo "<div class='error'>Categoria não encontrada.</div>";
                }
            
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Seção de Categorias Termina Aqui -->

