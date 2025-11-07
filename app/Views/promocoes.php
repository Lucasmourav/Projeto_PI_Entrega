<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Promoções - Doceria do Amor</title>
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo $BASE; ?>/css/estilos.css">
</head>
<body>
  <a class="skip-link" href="#conteudo">Pular para conteúdo</a>
  <header class="menu-bg">
    <div class="menu">
      <div class="menu-logo"><a href="<?php echo $BASE; ?>/">Doceria do Amor</a></div>
      <nav class="menu-nav" role="navigation" aria-label="Navegação principal">
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
  <section class="hero" role="img" aria-label="Doceria do Amor - Promoções">
    <div class="hero-content">
      <h1 class="title-brand">Promoções</h1>
      <p class="subtitle">Ofertas especiais para adoçar o seu dia.</p>
    </div>
  </section>

  <main id="conteudo" tabindex="-1">
  <section class="promocoes" style="max-width: 960px; margin: 40px auto;">
    <h1>Promoções</h1>
    <div class="promocoes-item">
      <h2>Morango do amor</h2>
      <p>Confira nossas promoções especiais para hoje!</p>
      <a class="botao" href="<?php echo $BASE; ?>/carrinho/adicionar?item=Morango%20do%20Amor&price=6">Aproveitar</a>
    </div>
    <div class="promocoes-item">
      <h2>Abacaxi do amor</h2>
      <p>Leve 2 e pague 1!</p>
      <a class="botao" href="<?php echo $BASE; ?>/carrinho/adicionar?item=Abacaxi%20do%20Amor&price=6">Aproveitar</a>
    </div>
  </section>

  <footer class="footer">
    <p>Doceria do Amor Todos os direitos reservados.</p>
  </footer>
  <script src="<?php echo $BASE; ?>/js/script.js"></script>
  </main>
</body>
</html>
