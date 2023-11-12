<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <!-- Importante para tornar o site responsivo -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buster-Burguer-Cliente</title>

    <!-- Link para o nosso arquivo CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Seção da Barra de Navegação Começa Aqui -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
            <a href="#" title="Logo">
                    <img src="images/teste.png" alt="Buster Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Início</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categorias</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Pratos</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>montagem.php">Montagem</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Seção da Barra de Navegação Termina Aqui -->
