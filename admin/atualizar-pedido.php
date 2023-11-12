<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Atualizar Pedido</h1>
        <br><br>

        <?php 
            // Verificar se o ID está definido
            if(isset($_GET['id']))
            {
                // Obter os detalhes do pedido
                $id = $_GET['id'];

                // Obter todos os outros detalhes com base neste ID
                // Consulta SQL para obter os detalhes do pedido
                $sql = "SELECT * FROM tbl_pedido WHERE id=$id";
                // Executar a consulta
                $res = mysqli_query($conn, $sql);
                // Contar as linhas
                $count = mysqli_num_rows($res);

                if($count == 1)
                {
                    // Detalhes disponíveis
                    $row = mysqli_fetch_assoc($res);

                    $comida = $row['comida'];
                    $preço = $row['preço'];
                    $quantidade = $row['quantidade'];
                    $status = $row['status'];
                    $nome_cliente = $row['nome_cliente'];
                    $contato_cliente = $row['contato_cliente'];
                    $email_cliente = $row['email_cliente'];
                    $endereco_cliente = $row['endereco_cliente'];
                }
                else
                {
                    // Detalhes não disponíveis
                    // Redirecionar para Gerenciar Pedidos
                    header('location:' . SITEURL . 'admin/gerenciar-pedido.php');
                }
            }
            else
            {
                // Redirecionar para a página de Gerenciar Pedidos
                header('location:' . SITEURL . 'admin/gerenciar-pedido.php');
            }
        ?>

        <form action="" method="POST">
        
            <table class="tbl-30">
                <tr>
                    <td>Nome do Prato</td>
                    <td><b><?php echo $comida; ?></b></td>
                </tr>

                <tr>
                    <td>Preço</td>
                    <td>
                        <b>R$ <?php echo $preço; ?></b>
                    </td>
                </tr>

                <tr>
                    <td>Quantidade</td>
                    <td>
                        <input type="number" name="quantidade" value="<?php echo $quantidade; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status == "Pedido"){ echo "selected"; } ?> value="Pedido">Pedido</option>
                            <option <?php if($status == "Em Entrega"){ echo "selected"; } ?> value="Em Entrega">Em Entrega</option>
                            <option <?php if($status == "Entregue"){ echo "selected"; } ?> value="Entregue">Entregue</option>
                            <option <?php if($status == "Cancelado"){ echo "selected"; } ?> value="Cancelado">Cancelado</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Nome do Cliente:</td>
                    <td>
                        <input type="text" name="nome_cliente" value="<?php echo $nome_cliente; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Contato do Cliente:</td>
                    <td>
                        <input type="text" name="contato_cliente" value="<?php echo $contato_cliente; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Email do Cliente:</td>
                    <td>
                        <input type="text" name="email_cliente" value="<?php echo $email_cliente; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Endereço do Cliente:</td>
                    <td>
                        <textarea name="endereco_cliente" cols="30" rows="5"><?php echo $endereco_cliente; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="preço" value="<?php echo $preço; ?>">

                        <input type="submit" name="submit" value="Atualizar Pedido" class="btn-secondary">
                    </td>
                </tr>
            </table>
        
        </form>

        <?php 
            // Verificar se o botão de atualização foi clicado
            if(isset($_POST['submit']))
            {
                // Obter todos os valores do formulário
                $id = $_POST['id'];
                $preço = $_POST['preço'];
                $quantidade = $_POST['quantidade'];

                $total = $preço * $quantidade;

                $status = $_POST['status'];

                $nome_cliente = $_POST['nome_cliente'];
                $contato_cliente = $_POST['contato_cliente'];
                $email_cliente = $_POST['email_cliente'];
                $endereco_cliente = $_POST['endereco_cliente'];

                // Atualizar os valores
                $sql2 = "UPDATE tbl_pedido SET 
                    quantidade = $quantidade,
                    total = $total,
                    status = '$status',
                    nome_cliente = '$nome_cliente',
                    contato_cliente = '$contato_cliente',
                    email_cliente = '$email_cliente',
                    endereco_cliente = '$endereco_cliente'
                    WHERE id = $id
                ";

                // Executar a consulta
                $res2 = mysqli_query($conn, $sql2);

                // Verificar se a atualização foi bem-sucedida ou não
                // E redirecionar para Gerenciar Pedidos com uma mensagem
                if($res2 == true)
                {
                    // Atualizado com sucesso
                    $_SESSION['update'] = "<div class='success'>Pedido atualizado com sucesso.</div>";
                    header('location:' . SITEURL . 'admin/gerenciar-pedido.php');
                }
                else
                {
                    // Falha na atualização
                    $_SESSION['update'] = "<div class='error'>Falha ao atualizar o pedido.</div>";
                    header('location:' . SITEURL . 'admin/gerenciar-pedido.php');
                }
            }
        ?>
    </div>
</div>
