<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Gerenciar Comida</h1>

        <br /><br />

        <!-- Botão para Adicionar Comida -->
        <a href="<?php echo SITEURL; ?>admin/add-comida.php" class="btn-primary">Adicionar Comida</a>

        <br /><br /><br />

        <?php 
            // Verifique e exiba as mensagens de sessão
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['unauthorize']))
            {
                echo $_SESSION['unauthorize'];
                unset($_SESSION['unauthorize']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        
        ?>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Título</th>
                <th>Preço</th>
                <th>Imagem</th>
                <th>Destaque</th>
                <th>Ativo</th>
                <th>Ações</th>
            </tr>

            <?php 
                // Crie uma consulta SQL para obter todas as comidas
                $sql = "SELECT * FROM tbl_comida";

                // Execute a consulta
                $res = mysqli_query($conn, $sql);

                // Contagem de linhas para verificar se temos comidas ou não
                $count = mysqli_num_rows($res);

                // Crie uma variável de número serial e defina o valor padrão como 1
                $sn = 1;

                if($count > 0)
                {
                    // Temos comidas no banco de dados
                    // Obtenha as comidas do banco de dados e exiba
                    while($row = mysqli_fetch_assoc($res))
                    {
                        // Obtenha os valores de cada coluna
                        $id = $row['id'];
                        $title = $row['titulo'];
                        $price = $row['preço'];
                        $image_name = $row['nome_imagem'];
                        $featured = $row['destacado'];
                        $active = $row['ativo'];
                        ?>

                        <tr>
                            <td><?php echo $sn++; ?>. </td>
                            <td><?php echo $title; ?></td>
                            <td>R$<?php echo $price; ?></td>
                            <td>
                                <?php  
                                    // Verifique se temos imagem ou não
                                    if($image_name == "")
                                    {
                                        // Não temos imagem, exibe uma mensagem de erro
                                        echo "<div class='error'>Imagem não adicionada.</div>";
                                    }
                                    else
                                    {
                                        // Temos imagem, exibe a imagem
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                        <?php
                                    }
                                ?>
                            </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/atualizar-comida.php?id=<?php echo $id; ?>" class="btn-secondary">Atualizar Comida</a>
                                <a href="<?php echo SITEURL; ?>admin/deletar-comida.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Excluir Comida</a>
                            </td>
                        </tr>

                        <?php
                    }
                }
                else
                {
                    // Comida não adicionada no banco de dados
                    echo "<tr> <td colspan='7' class='error'> Comida não adicionada ainda. </td> </tr>";
                }

            ?>
        </table>
    </div>
</div>
