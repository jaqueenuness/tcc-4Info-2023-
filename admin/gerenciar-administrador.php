<?php include('partials/menu.php'); ?>

<!-- Início da Seção de Conteúdo Principal -->
<div class="main-content">
    <div class="wrapper">
        <h1>Gerenciar Administradores</h1>

        <br />

        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add']; // Exibindo a Mensagem da Sessão
                unset($_SESSION['add']); // Removendo a Mensagem da Sessão
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['user-not-found']))
            {
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
            }

            if(isset($_SESSION['pwd-not-match']))
            {
                echo $_SESSION['pwd-not-match'];
                unset($_SESSION['pwd-not-match']);
            }

            if(isset($_SESSION['change-pwd']))
            {
                echo $_SESSION['change-pwd'];
                unset($_SESSION['change-pwd']);
            }
        ?>
        <br><br><br>

        <!-- Botão para Adicionar Administrador -->
        <a href="add-administrador.php" class="btn-primary">Adicionar Administrador</a>

        <br /><br /><br />

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Nome Completo</th>
                <th>Nome de Usuário</th>
                <th>Ações</th>
            </tr>

            
            <?php 
                // Consulta para Obter todos os Administradores
                $sql = "SELECT * FROM tbl_administrador";
                // Executa a Consulta
                $res = mysqli_query($conn, $sql);

                // Verifica se a Consulta foi Executada ou Não
                if($res==TRUE)
                {
                    // Conta as Linhas para Verificar se temos dados no banco de dados ou não
                    $count = mysqli_num_rows($res); // Função para obter todas as linhas no banco de dados

                    $sn=1; // Cria uma Variável e Atribui o Valor

                    // Verifica o número de linhas
                    if($count>0)
                    {
                        // Temos dados no banco de dados
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            // Usando um loop while para obter todos os dados do banco de dados.
                            // E o loop while será executado enquanto tivermos dados no banco de dados

                            // Obter Dados Individuais
                            $id=$rows['id'];
                            $full_name=$rows['nome_completo'];
                            $username=$rows['nome_de_usuario'];

                            // Exibe os Valores em nossa Tabela
                            ?>
                            
                            <tr>
                                <td><?php echo $sn++; ?>. </td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/atualizar-senha.php?id=<?php echo $id; ?>" class="btn-primary">Alterar Senha</a>
                                    <a href="<?php echo SITEURL; ?>admin/atualizar-administrador.php?id=<?php echo $id; ?>" class="btn-secondary">Atualizar Administrador</a>
                                    <a href="<?php echo SITEURL; ?>admin/deletar-administrador.php?id=<?php echo $id; ?>" class="btn-danger">Excluir Administrador</a>
                                </td>
                            </tr>

                            <?php
                        }
                    }
                    else
                    {
                        // Não Temos Dados no Banco de Dados
                    }
                }
            ?>


            
        </table>

    </div>
</div>
<!-- Fim da Seção de Conteúdo Principal -->
