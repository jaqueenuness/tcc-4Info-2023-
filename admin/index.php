<?php include('partials/menu.php'); ?>

<!-- Seção de Conteúdo Principal Começa -->
<div class="main-content">
    <div class="wrapper">
        <h1>Painel de Controle</h1>
        <br><br>
        <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
        ?>
        <br><br>

        <div class="col-4 text-center">

            <?php 
                // Consulta SQL para Categorias
                $sql = "SELECT * FROM tbl_categoria";
                // Executa a Consulta
                $res = mysqli_query($conn, $sql);
                // Conta as Linhas
                $count = mysqli_num_rows($res);
            ?>

            <h1><?php echo $count; ?></h1>
            <br />
            Categorias
        </div>

        <div class="col-4 text-center">

            <?php 
                // Consulta SQL para Alimentos
                $sql2 = "SELECT * FROM tbl_comida";
                // Executa a Consulta
                $res2 = mysqli_query($conn, $sql2);
                // Conta as Linhas
                $count2 = mysqli_num_rows($res2);
            ?>

            <h1><?php echo $count2; ?></h1>
            <br />
            Alimentos
        </div>

        <div class="col-4 text-center">
            
            <?php 
                // Consulta SQL para Pedidos
                $sql3 = "SELECT * FROM tbl_pedido";
                // Executa a Consulta
                $res3 = mysqli_query($conn, $sql3);
                // Conta as Linhas
                $count3 = mysqli_num_rows($res3);
            ?>

            <h1><?php echo $count3; ?></h1>
            <br />
            Total de Pedidos
        </div>

        <div class="col-4 text-center">
            
            <?php 
                // Crie uma Consulta SQL para Obter a Receita Total Gerada
                // Função de Agregação em SQL
                $sql4 = "SELECT SUM(total) AS Total FROM tbl_pedido WHERE status='Entregue'";

                // Execute a Consulta
                $res4 = mysqli_query($conn, $sql4);

                // Obtenha o Valor
                $row4 = mysqli_fetch_assoc($res4);

                // Obtenha a Receita Total
                $total_revenue = $row4['Total'];

            ?>

            <h1>R$<?php echo number_format($total_revenue, 2, ',', '.'); ?></h1>
            <br />
            Receita Gerada
        </div>

        <div class="clearfix"></div>

    </div>
</div>
<!-- Seção de Conteúdo Principal Termina -->
