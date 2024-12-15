<?php 
    //Define as informações de acesso 
    define('DB_SERVIDOR','localhost:3306');
    define('DB_USUARIO','root');
    define('DB_SENHA','12345678');
    define('DB_BANCO','livraria');

    $dbc = @mysqli_connect(DB_SERVIDOR,DB_USUARIO,DB_SENHA,DB_BANCO) or die ("Não foi possível conectar ao MYSQL: " . mysqli_connect_error());
?>