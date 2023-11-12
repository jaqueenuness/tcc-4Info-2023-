<?php 
    // Inclui constants.php para SITEURL
    include('../config/constants.php');
    
    // 1. Destrói a Sessão
    session_destroy(); // Desfaz $_SESSION['user']

    // 2. Redireciona para a Página de Login
    header('location:'.SITEURL.'admin/login.php');
?>
