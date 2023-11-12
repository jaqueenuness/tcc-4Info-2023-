<?php 
// Autorização - Controle de Acesso
// Verifique se o usuário está logado ou não
if (!isset($_SESSION['user'])) { // Se a sessão do usuário não estiver definida
    // O usuário não está logado
    // Redirecionar para a página de login com uma mensagem
    $_SESSION['no-login-message'] = "<div class='error text-center'>Por favor, faça o login para acessar o Painel de Administração.</div>";
    // Redirecionar para a página de login
    header('location:' . SITEURL . 'admin/login.php');
}
?>
