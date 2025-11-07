<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Produtos - Doceria do Amor</title>
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
          <li><a href="<?php echo $BASE; ?>/cardapio">Cardápio</a></li>
          <li><a href="<?php echo $BASE; ?>/promocoes">Promoções</a></li>
          <li><a href="<?php echo $BASE; ?>/contato">Fale Conosco</a></li>
          <li><a href="<?php echo $BASE; ?>/carrinho">Carrinho</a></li>
          <li><a href="<?php echo $BASE; ?>/login" aria-current="page">Login / Cadastro</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <section class="hero" role="img" aria-label="Doceria do Amor - Produtos">
    <div class="hero-content">
      <h1 class="title-brand">Nossos Produtos</h1>
      <p class="subtitle">Doces que encantam no primeiro olhar.</p>
    </div>
  </section>

  <section class="produtos section" style="max-width: 960px; margin: 40px auto;">
    <h1>Produtos</h1>
    <div class="produtos-container">
      <div class="produtos-item purple">
        <h2>Morangos do Amor</h2>
        <img src="<?php echo $BASE; ?>/img/produtos1.png" alt="Produtos 1">
        <a class="botao" href="<?php echo $BASE; ?>/carrinho/adicionar?item=Morangos%20do%20Amor&price=8">Adicionar ao carrinho</a>
      </div>
      <div class="produtos-item pink">
        <h2>Abacaxi do Amor</h2>
        <img src="<?php echo $BASE; ?>/img/produtos2.png" alt="Produtos 2">
        <a class="botao" href="<?php echo $BASE; ?>/carrinho/adicionar?item=Abacaxi%20do%20Amor&price=8">Adicionar ao carrinho</a>
      </div>
      <div class="produtos-item blue">
        <h2>Uva do Amor</h2>
        <img src="<?php echo $BASE; ?>/img/produtos3.png" alt="Produtos 3">
        <a class="botao" href="<?php echo $BASE; ?>/carrinho/adicionar?item=Uva%20do%20Amor&price=8">Adicionar ao carrinho</a>
      </div>
    </div>
  </section>

  <footer class="footer">
    <p>Doceria do Amor Todos os direitos reservados.</p>
  </footer>
  <script src="<?php echo $BASE; ?>/js/script.js"></script>
</body>
</html>
