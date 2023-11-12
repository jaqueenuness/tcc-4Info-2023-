<?php include('partials-front/menu.php'); ?>

<?php 
    // Verifica se o ID do alimento está definido
    if(isset($_GET['food_id']))
    {
        // Obtenha o ID do alimento e os detalhes do alimento selecionado
        $food_id = $_GET['food_id'];

        // Obtenha os detalhes do alimento selecionado
        $sql = "SELECT * FROM tbl_comida WHERE id=$food_id";
        // Execute a consulta
        $res = mysqli_query($conn, $sql);
        // Conte o número de linhas
        $count = mysqli_num_rows($res);
        // Verifique se os dados estão disponíveis ou não
        if($count == 1)
        {
            // Temos dados
            // Obtenha os dados do banco de dados
            $row = mysqli_fetch_assoc($res);

            $titulo = $row['titulo'];
            $preço = $row['preço'];
            $nome_imagem = $row['nome_imagem'];
        }
        else
        {
            // Comida não disponível
            // Redirecione para a página inicial
            header('location:'.SITEURL);
        }
    }
    else
    {
        // Redirecione para a página inicial
        header('location:'.SITEURL);
    }
?>

<!-- Seção de pesquisa de alimentos começa aqui -->
<section class="food-search">
    <div class="container">
        
        <h2 class="text-center text-white">Preencha este formulário para confirmar o seu pedido.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Comida Selecionada</legend>

                <div class="food-menu-img">
                    <?php 
                        // Verifique se a imagem está disponível ou não
                        if($nome_imagem == "")
                        {
                            // Imagem não disponível
                            echo "<div class='error'>Imagem não disponível.</div>";
                        }
                        else
                        {
                            // Imagem disponível
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $nome_imagem; ?>" alt="" class="img-responsive img-curve">
                            <?php
                        }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $titulo; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $titulo; ?>">

                    <p class="food-price">R$<?php echo $preço; ?></p>
                    <input type="hidden" name="preço" value="<?php echo $preço; ?>">

                    <div class="order-label">Quantidade</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>
                </div>
            </fieldset>

            <fieldset>
                <legend>Detalhes de Entrega</legend>
                <div class="order-label">Nome Completo</div>
                <input type="text" name="full-name" placeholder="Exemplo: João Silva" class="input-responsive" required>

                <div class="order-label">Número de Telefone</div>
                <input type="tel" name "contact" placeholder="Exemplo: 98123xxxx" class="input-responsive" required>

                <div class="order-label">E-mail</div>
                <input type="email" name="email" placeholder="Exemplo: joao@email.com" class= "input-responsive" required>

                <div class "order-label">Endereço</div>
                <textarea name="address" rows="10" placeholder="Exemplo: Rua, Cidade, País" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirmar Pedido" class="btn btn-primary">
            </fieldset>
        </form>

        <?php 
            // Verifique se o botão de envio foi clicado ou não
            if(isset($_POST['submit']))
            {
                // Obtenha todos os detalhes do formulário
                $food = $_POST['food'];
                $preço = $_POST['preço'];
                $qty = $_POST['qty'];
                $total = $preço * $qty; // total = preço x quantidade 
                $order_date = date("Y-m-d h:i:sa"); // Data do Pedido
                $status = "Pedido"; // Pedido, Em Entrega, Entregue, Cancelado
                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];

                // Salvar o Pedido no Banco de Dados
                // Crie SQL para salvar os dados
                $sql2 = "INSERT INTO tbl_pedido SET 
                    comida = '$food',
                    preço = $preço,
                    quantidade = $qty,
                    total = $total,
                    data_pedido = '$order_date',
                    status = '$status',
                    nome_cliente = '$customer_name',
                    contato_cliente = '$customer_contact',
                    email_cliente = '$customer_email',
                    endereco_cliente = '$customer_address'
                ";

                // Execute a consulta
                $res2 = mysqli_query($conn, $sql2);

                // Verifique se a consulta foi executada com sucesso ou não
                if($res2 == true)
                {
                    // Consulta executada e Pedido Salvo
                    $_SESSION['order'] = "<div class='success text-center'>Comida pedida com sucesso.</div>";
                    header('location:'.SITEURL);
                }
                else
                {
                    // Falha ao Salvar o Pedido
                    $_SESSION['order'] = "<div class='error text-center'>Falha ao pedir comida.</div>";
                    header('location:'.SITEURL);
                }
            }
        ?>
    </div>
</section>
<!-- Seção de pesquisa de alimentos termina aqui -->
