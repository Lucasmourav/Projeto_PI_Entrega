<?php
    // Carrega automaticamente todas as dependências instaladas via Composer
    require __DIR__ . '/../vendor/autoload.php';

    // Inicia a sessão caso ainda não esteja iniciada
    if (session_status() === PHP_SESSION_NONE) { session_start(); }

    // Pega apenas o caminho da URL atual (sem parâmetros)
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    // Define o caminho base do projeto (remove barras e ajusta formato)
    $basePath = rtrim(str_replace('\\','/', dirname($_SERVER['SCRIPT_NAME'])), '/');

    // Torna o caminho base acessível nas views
    $BASE = $basePath;

    // Define o caminho que será usado para o roteamento
    $path = $url;

    // Remove o caminho base do início da URL, se existir
    if ($basePath !== '' && str_starts_with($path, $basePath)) {
        $path = substr($path, strlen($basePath));
    }

    // Garante que o caminho comece com uma barra (/)
    $path = '/' . ltrim($path, '/');

    // Cria o carrinho na sessão, caso ainda não exista
    if (!isset($_SESSION['cart'])) { $_SESSION['cart'] = []; }

    // Início do roteamento de páginas
    switch ($path) {
        // Página inicial
        case '/':
        case '/index.php':
            require __DIR__ . '/../app/Views/home.php';
            exit;

        // Página "sobre"
        case '/sobre':
            require __DIR__ . '/../app/Views/sobre.php';
            exit;

        // Página "produtos"
        case '/produtos':
            require __DIR__ . '/../app/Views/produtos.php';
            exit;

        // Página "cardápio"
        case '/cardapio':
            require __DIR__ . '/../app/Views/cardapio.php';
            exit;

        // Página "promoções"
        case '/promocoes':
            require __DIR__ . '/../app/Views/promocoes.php';
            exit;

        // Página "contato"
        case '/contato':
            $contato_enviado = false; // Controle se o formulário foi enviado
            $erro_contato = ''; // Mensagem de erro

        

            // Se o método da requisição for POST (formulário enviado)
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Captura e limpa o e-mail e a mensagem
                $email = trim($_POST['email'] ?? '');
                $mensagem = trim($_POST['mensagem'] ?? '');

                // Verifica se ambos os campos foram preenchidos
                if ($email !== '' && $mensagem !== '') {
                    $contato_enviado = true; // Marca como enviado (placeholder)
                } else {
                    $erro_contato = 'Preencha e-mail e mensagem.'; // Mostra erro
                }
            }

            // Carrega a view de contato
            require __DIR__ . '/../app/Views/contato.php';
            exit;

        // Página do carrinho
        case '/carrinho':
            $cart = $_SESSION['cart']; // Pega o carrinho atual da sessão
            require __DIR__ . '/../app/Views/carrinho.php'; // Mostra a view
            exit;

        // Adicionar item ao carrinho
        case '/carrinho/adicionar':
            $item  = trim($_GET['item']  ?? ''); // Nome do item
            $price = (float)($_GET['price'] ?? 0); // Preço do item

            // Se o item for válido
            if ($item !== '') {
                // Se o item ainda não existe no carrinho, cria ele
                if (!isset($_SESSION['cart'][$item])) { 
                    $_SESSION['cart'][$item] = ['qtd' => 0, 'price' => $price]; 
                }

                // Aumenta a quantidade do item
                $_SESSION['cart'][$item]['qtd']++;

                // Atualiza o preço se for maior que 0
                if ($price > 0) { $_SESSION['cart'][$item]['price'] = $price; }
            }

            // Redireciona de volta para o carrinho
            header('Location: ' . $basePath . '/carrinho');
            exit;

        // Remover item do carrinho
        case '/carrinho/remover':
            $item = trim($_GET['item'] ?? ''); // Pega o nome do item

            // Se o item existir no carrinho, remove ele
            if ($item !== '' && isset($_SESSION['cart'][$item])) {
                unset($_SESSION['cart'][$item]);
            }

            // Redireciona de volta para o carrinho
            header('Location: ' . $basePath . '/carrinho');
            exit;
        // Página de login e cadastro
        case '/login':
            $erro_login = '';
            $sucesso_cadastro = '';

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $acao = $_POST['acao'] ?? '';

                // Simulação de login/cadastro (sem banco)
                if ($acao === 'login') {
                    $email = trim($_POST['email_login'] ?? '');
                    $senha = trim($_POST['senha_login'] ?? '');
                    
                    // Exemplo simples de login
                    if ($email === 'teste@doceria.com' && $senha === '1234') {
                        $_SESSION['usuario'] = $email;
                        header('Location: ' . $basePath . '/');
                        exit;
                    } else {
                        $erro_login = 'E-mail ou senha incorretos.';
                    }
                }

                if ($acao === 'cadastro') {
                    $nome = trim($_POST['nome_cadastro'] ?? '');
                    $email = trim($_POST['email_cadastro'] ?? '');
                    $senha = trim($_POST['senha_cadastro'] ?? '');

                    if ($nome !== '' && $email !== '' && $senha !== '') {
                        // Aqui você poderia salvar no banco (exemplo simplificado)
                        $sucesso_cadastro = 'Cadastro realizado com sucesso! Agora você pode entrar.';
                    } else {
                        $erro_login = 'Preencha todos os campos para se cadastrar.';
                    }
                }
            }

            require __DIR__ . '/../app/Views/login.php';
            exit;
    }

    // Se nenhuma rota for encontrada, retorna erro 404
    http_response_code(404);
    readfile(__DIR__ . '/404.html'); // Exibe página de erro 404
?>
