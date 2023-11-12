<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Adicionar Categoria</h1>

        <br><br>

        <?php 
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        
        ?>

        <br><br>

        <!-- Formulário de Adicionar Categoria Começa -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Título: </td>
                    <td>
                        <input type="text" name="titulo" placeholder="Título da Categoria">
                    </td>
                </tr>

                <tr>
                    <td>Selecionar Imagem: </td>
                    <td>
                        <input type="file" name="imagem">
                    </td>
                </tr>

                <tr>
                    <td>Destaque: </td>
                    <td>
                        <input type="radio" name="destacado" value="Sim"> Sim 
                        <input type="radio" name="destacado" value="Não"> Não 
                    </td>
                </tr>

                <tr>
                    <td>Ativo: </td>
                    <td>
                        <input type="radio" name="ativo" value="Sim"> Sim 
                        <input type="radio" name="ativo" value="Não"> Não 
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Adicionar Categoria" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
        <!-- Formulário de Adicionar Categoria Termina -->

        <?php 
        
            // Verificar se o botão de envio foi clicado ou não
            if(isset($_POST['submit']))
            {
                // 1. Obter o valor do formulário de Categoria
                $titulo = $_POST['titulo'];
                $destacado = isset($_POST['destacado']) ? $_POST['destacado'] : "Não";
                $ativo = isset($_POST['ativo']) ? $_POST['ativo'] : "Não";

                // Verificar se a imagem está selecionada ou não e definir o valor do nome da imagem de acordo
                if(isset($_FILES['imagem']['name']))
                {
                    $nome_imagem = $_FILES['imagem']['name'];
                    
                    // Enviar a imagem apenas se a imagem estiver selecionada
                    if($nome_imagem != "")
                    {
                        // Renomear automaticamente nossa imagem
                        $ext = pathinfo($nome_imagem, PATHINFO_EXTENSION);
                        $nome_imagem = "Food_Category_" . rand(000, 999) . '.' . $ext;

                        $source_path = $_FILES['imagem']['tmp_name'];
                        $destination_path = "../images/category/" . $nome_imagem;

                        // Finalmente, envie a imagem
                        $upload = move_uploaded_file($source_path, $destination_path);

                        // Verificar se a imagem foi enviada ou não
                        // E se a imagem não foi enviada, interromper o processo e redirecionar com a mensagem de erro
                        if($upload == false)
                        {
                            $_SESSION['upload'] = "<div class='error'>Falha ao Enviar a Imagem.</div>";
                            header('location:' . SITEURL . 'admin/add-categoria.php');
                            die();
                        }
                    }
                }
                else
                {
                    // Não envie a imagem e defina o valor do nome da imagem como em branco
                    $nome_imagem = "";
                }

                // 2. Criar a Consulta SQL para Inserir a Categoria no Banco de Dados
                $sql = "INSERT INTO tbl_categoria (titulo, nome_imagem, destacado, ativo)
                        VALUES ('$titulo', '$nome_imagem', '$destacado', '$ativo')";

                // 3. Executar a Consulta e Salvar no Banco de Dados
                $res = mysqli_query($conn, $sql);

                // 4. Verificar se a consulta foi executada e se a categoria foi adicionada
                if($res == true)
                {
                    $_SESSION['add'] = "<div class='success'>Categoria Adicionada com Sucesso.</div>";
                    header('location:' . SITEURL . 'admin/gerenciar-categoria.php');
                }
                else
                {
                    $_SESSION['add'] = "<div class='error'>Falha ao Adicionar a Categoria.</div>";
                    header('location:' . SITEURL . 'admin/add-categoria.php');
                }
            }
        
        ?>

    </div>
</div>
