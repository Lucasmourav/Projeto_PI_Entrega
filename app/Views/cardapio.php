<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cardapio - Doceria do Amor</title>
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo $BASE; ?>/css/estilos.css">
</head>
<body>
  <header class="menu-bg">
    <div class="menu">
      <div class="menu-logo"><a href="<?php echo $BASE; ?>/">Doceria do Amor</a></div>
      <nav class="menu-nav">
        <ul>
          <li><a href="<?php echo $BASE; ?>/sobre">Sobre</a></li>
          <li><a href="<?php echo $BASE; ?>/produtos">Produtos</a></li>
          <li><a href="<?php echo $BASE; ?>/cardapio" aria-current="page">Cardapio</a></li>
          <li><a href="<?php echo $BASE; ?>/promocoes">Promocoes</a></li>
          <li><a href="<?php echo $BASE; ?>/contato">Fale Conosco</a></li>
          <li><a href="<?php echo $BASE; ?>/carrinho">Carrinho</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <section class="hero" role="img" aria-label="Doceria do Amor - Cardápio">
    <div class="hero-content">
      <h1 class="title-brand">Cardápio</h1>
      <p class="subtitle">Escolha seu favorito e aproveite!</p>
    </div>
  </section>

  <section class="cardapio section" style="max-width: 960px; margin: 40px auto;">
    <h1>Cardapio</h1>
    <div class="cardapio-item">
      <h2>Morangos do Amor</h2>
      <span><del>R$15</del> <ins>R$8</ins></span>
      <ul>
        <li>Planos Ilimitados</li>
        <li>Acesso Restrito</li>
        <li>Conteúdo Secreto</li>
        <li>Suporte 24h</li>
      </ul>
      <a class="botao" href="<?php echo $BASE; ?>/carrinho/adicionar?item=Morangos%20do%20Amor&price=8">Comprar</a>
    </div>

    <div class="cardapio-item">
      <h2>Abacaxi do Amor</h2>
      <span><del>R$12</del> <ins>R$8</ins></span>
      <ul>
        <li>Planos Ilimitados</li>
        <li>Acesso Restrito</li>
        <li>Conteúdo Secreto</li>
        <li>Suporte 24h</li>
        <li>Compra Exclusiva</li>
      </ul>
      <a class="botao" href="<?php echo $BASE; ?>/carrinho/adicionar?item=Abacaxi%20do%20Amor&price=8">Comprar</a>
    </div>

    <div class="cardapio-item">
      <h2>Uva do Amor</h2>
      <span><del>R$16</del> <ins>R$8</ins></span>
      <ul>
        <li>Planos Ilimitados</li>
        <li>Acesso Restrito</li>
        <li>Conteúdo Secreto</li>
        <li>Suporte 24h</li>
        <li>Compra Exclusiva</li>
        <li>Download dos Itens</li>
      </ul>
      <a class="botao" href="<?php echo $BASE; ?>/carrinho/adicionar?item=Uva%20do%20Amor&price=8">Comprar</a>
    </div>
  </section>

  <footer class="footer">
    <p>Doceria do Amor Todos os direitos reservados.</p>
  </footer>
  <script src="<?php echo $BASE; ?>/js/script.js"></script>
</body>
</html>
