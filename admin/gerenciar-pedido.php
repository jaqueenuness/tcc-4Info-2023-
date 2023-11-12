<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center text-white">Gerenciar Pedidos</h1>

        <br /><br /><br />

        <?php 
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>
        <br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Comida</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Total</th>
                <th>Data do Pedido</th>
                <th>Status</th>
                <th>Nome do Cliente</th>
                <th>Contato</th>
                <th>Email</th>
                <th>Endereço</th>
                <th>Ações</th>
            </tr>

            <?php 
                date_default_timezone_set('America/Sao_Paulo'); // Define o fuso horário para São Paulo (UTC-3)

                $current_time = date('H:i:s'); // Obtém a hora atual no formato HH:MM:SS
                $start_time = '08:00:00'; // Hora de início (08:00:00)
                $end_time = '20:00:00'; // Hora de término (20:00:00)

                // Verifica se o horário atual está dentro do intervalo de tempo permitido
                if ($current_time >= $start_time && $current_time <= $end_time) {
                    // O horário atual está dentro do intervalo permitido
                    // Prossiga para buscar e exibir os pedidos
                    // Obter todos os pedidos do banco de dados
                    $sql = "SELECT * FROM tbl_pedido ORDER BY id DESC"; // Exibe o pedido mais recente primeiro
                    // Executar a consulta
                    $res = mysqli_query($conn, $sql);
                    // Contar as linhas
                    $count = mysqli_num_rows($res);

                    $sn = 1; // Criar um número de série e definir seu valor inicial como 1

                    if ($count > 0) {
                        // Pedido disponível
                        while ($row = mysqli_fetch_assoc($res)) {
                            // Obter todos os detalhes do pedido
                            $id = $row['id'];
                            $food = $row['comida'];
                            $preço = $row['preço'];
                            $qty = $row['quantidade'];
                            $total = $row['total'];
                            $order_date = $row['data_pedido'];
                            $status = $row['status'];
                            $customer_name = $row['nome_cliente'];
                            $customer_contact = $row['contato_cliente'];
                            $customer_email = $row['email_cliente'];
                            $customer_address = $row['endereco_cliente'];

                            // Código PHP atualizado para exibir os nomes de status em português
                            $status_pt = '';
                            if ($status == "Pedido") {
                                $status_pt = "Pedido";
                            } elseif ($status == "Em Entrega") {
                                $status_pt = "Em Entrega";
                            } elseif ($status == "Entregue") {
                                $status_pt = "Entregue";
                            } elseif ($status == "Cancelado") {
                                $status_pt = "Cancelado";
                            }
                            ?>

                            <tr>
                                <td><?php echo $sn++; ?>. </td>
                                <td><?php echo $food; ?></td>
                                <td><?php echo "R$ " . $preço; ?></td>
                                <td><?php echo $qty; ?></td>
                                <td><?php echo "R$ " . $total; ?></td>
                                <td><?php echo $order_date; ?></td>

                                <td>
                                    <?php 
                                        if($status == "Pedido")
                                        {
                                            echo "<label style='color: #ffcc29;'>$status_pt</label>";
                                        }
                                        elseif($status == "Em Entrega")
                                        {
                                            echo "<label style='color: #ff9900;'>$status_pt</label>";
                                        }
                                        elseif($status == "Entregue")
                                        {
                                            echo "<label style='color: #33cc33;'>$status_pt</label>";
                                        }
                                        elseif($status == "Cancelado")
                                        {
                                            echo "<label style='color: #ff3333;'>$status_pt</label>";
                                        }
                                    ?>
                                </td>

                                <td><?php echo $customer_name; ?></td>
                                <td><?php echo $customer_contact; ?></td>
                                <td><?php echo $customer_email; ?></td>
                                <td><?php echo $customer_address; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/atualizar-pedido.php?id=<?php echo $id; ?>" class="btn-secondary">Atualizar Pedido</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        // Pedido não disponível
                        echo "<tr><td colspan='12' class='error'>Pedidos não disponíveis</td></tr>";
                    }
                } else {
                    // O horário atual está fora do intervalo permitido
                    echo '<tr><td colspan="12" class="error">Os pedidos só estão disponíveis entre as 08:00 e 20:00.</td></tr>';
                }
            ?>
        </table>
    </div>
</div>
