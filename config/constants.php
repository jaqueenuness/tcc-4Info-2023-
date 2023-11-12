<?php
    // Iniciar sessão
   

    // Definir constantes para armazenar valores que não se repetem
    define('SITEURL', 'http://localhost/projeto-main/');
    define('LOCALHOST', '127.0.0.1');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'buster-buguer');
    
    // Conectar ao banco de dados MySQL
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); // Conexão com o banco de dados
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); // Selecionar o banco de dados
?>
