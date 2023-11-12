<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Gerenciar Categorias</h1>

        <br /><br />
        <?php 
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['no-category-found']))
            {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
        
        ?>
        <br><br>

        <!-- Botão para Adicionar Categoria -->
        <a href="<?php echo SITEURL; ?>admin/add-categoria.php" class="btn-primary">Adicionar Categoria</a>

        <br /><br /><br />

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Título</th>
                <th>Imagem</th>
                <th>Destaque</th>
                <th>Ativa</th>
                <th>Ações</th>
            </tr>

            <?php 

            // Consulta para obter todas as Categorias do Banco de Dados
            $sql = "SELECT * FROM tbl_categoria";

            // Execute a Consulta
            $res = mysqli_query($conn, $sql);

            // Contar as Linhas
            $count = mysqli_num_rows($res);

            // Cria a Variável de Número Serial e atribui o valor como 1
            $sn = 1;

            // Verifique se temos dados no banco de dados ou não
            if($count > 0)
            {
                // Temos dados no banco de dados
                // Obtenha os dados e exiba
                while($row = mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $titulo = $row['titulo'];
                    $nome_imagem = $row['nome_imagem'];
                    $destacado = $row['destacado'];
                    $ativo = $row['ativo'];

                    ?>

                    <tr>
                        <td><?php echo $sn++; ?>. </td>
                        <td><?php echo $titulo; ?></td>

                        <td>
                            <?php  
                            // Verifique se o nome da imagem está disponível
                            if($nome_imagem != "")
                            {
                                // Exibe a Imagem
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $nome_imagem; ?>" width="100px" >
                                <?php
                            }
                            else
                            {
                                // Exiba a Mensagem
                                echo "<div class='error'>Imagem não adicionada.</div>";
                            }
                            ?>
                        </td>

                        <td><?php echo $destacado == "Sim" ? "Sim" : "Não"; ?></td>
                        <td><?php echo $ativo == "Sim" ? "Sim" : "Não"; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/atualizar-categoria.php?id=<?php echo $id; ?>" class="btn-secondary">Atualizar Categoria</a>
                            <a href="<?php echo SITEURL; ?>admin/deletar-categoria.php?id=<?php echo $id; ?>&nome_imagem=<?php echo $nome_imagem; ?>" class="btn-danger">Excluir Categoria</a>
                        </td>
                    </tr>

                    <?php
                }
            }
            else
            {
                // Não temos dados
                // Vamos exibir a mensagem dentro da tabela
                ?>

                <tr>
                    <td colspan="6"><div class='error'>Nenhuma categoria adicionada.</div></td>
                </tr>

                <?php
            }
            ?>
        </table>
    </div>
</div>
