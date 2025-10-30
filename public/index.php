<?php
    //importa o upload do composer para carregar as rotas
    require __DIR__ . '/../vendor/autoload.php';
    //obtem a URL do navegador 
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    
    if ($url == "/") {
        // Carrega a view inicial
        require __DIR__ . '/../app/Views/home.php';
    }
    
?>