<?php
    require __DIR__ . '/../vendor/autoload.php';
    if (session_status() === PHP_SESSION_NONE) { session_start(); }

    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $basePath = rtrim(str_replace('\\','/', dirname($_SERVER['SCRIPT_NAME'])), '/');
    $BASE = $basePath; // expose to views
    $path = $url;
    if ($basePath !== '' && str_starts_with($path, $basePath)) {
        $path = substr($path, strlen($basePath));
    }
    $path = '/' . ltrim($path, '/');

    if (!isset($_SESSION['cart'])) { $_SESSION['cart'] = []; }

    switch ($path) {
        case '/':
        case '/index.php':
            require __DIR__ . '/../app/Views/home.php';
            exit;

        case '/sobre':
            require __DIR__ . '/../app/Views/sobre.php';
            exit;

        case '/produtos':
            require __DIR__ . '/../app/Views/produtos.php';
            exit;

        case '/cardapio':
            require __DIR__ . '/../app/Views/cardapio.php';
            exit;

        case '/promocoes':
            require __DIR__ . '/../app/Views/promocoes.php';
            exit;

        case '/contato':
            $contato_enviado = false;
            $erro_contato = '';
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $email = trim($_POST['email'] ?? '');
                $mensagem = trim($_POST['mensagem'] ?? '');
                if ($email !== '' && $mensagem !== '') {
                    $contato_enviado = true; // placeholder
                } else {
                    $erro_contato = 'Preencha e-mail e mensagem.';
                }
            }
            require __DIR__ . '/../app/Views/contato.php';
            exit;

        case '/carrinho':
            $cart = $_SESSION['cart'];
            require __DIR__ . '/../app/Views/carrinho.php';
            exit;

        case '/carrinho/adicionar':
            $item  = trim($_GET['item']  ?? '');
            $price = (float)($_GET['price'] ?? 0);
            if ($item !== '') {
                if (!isset($_SESSION['cart'][$item])) { $_SESSION['cart'][$item] = ['qtd' => 0, 'price' => $price]; }
                $_SESSION['cart'][$item]['qtd']++;
                if ($price > 0) { $_SESSION['cart'][$item]['price'] = $price; }
            }
            header('Location: ' . $basePath . '/carrinho');
            exit;

        case '/carrinho/remover':
            $item = trim($_GET['item'] ?? '');
            if ($item !== '' && isset($_SESSION['cart'][$item])) {
                unset($_SESSION['cart'][$item]);
            }
            header('Location: ' . $basePath . '/carrinho');
            exit;
    }

    http_response_code(404);
    readfile(__DIR__ . '/404.html');
?>