<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fale Conosco - Doceria do Amor</title>
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
  <section class="hero" role="img" aria-label="Doceria do Amor - Contato">
    <div class="hero-content">
      <h1 class="title-brand">Fale Conosco</h1>
      <p class="subtitle">Estamos prontos para adoçar sua experiência.</p>
    </div>
  </section>

  <section class="contato">
    <h1>Fale Conosco</h1>
    <?php if (!empty($contato_enviado)) : ?>
      <div class="alert success">Mensagem enviada! Em breve retornaremos.</div>
    <?php elseif (!empty($erro_contato)) : ?>
      <div class="alert error"><?php echo htmlspecialchars($erro_contato); ?></div>
    <?php endif; ?>
    <form class="contato-form" method="post" action="<?php echo $BASE; ?>/contato" novalidate>
      <div class="form-group">
        <label for="nome">Seu nome</label>
        <input id="nome" name="nome" type="text" placeholder="Seu nome completo" autocomplete="name">
      </div>
      <div class="form-group">
        <label for="email">Seu e-mail</label>
        <input id="email" name="email" type="email" placeholder="voce@exemplo.com" required autocomplete="email">
        <span class="hint">Usaremos para responder sua mensagem.</span>
      </div>
      <div class="form-group">
        <label for="assunto">Assunto</label>
        <select id="assunto" name="assunto">
          <option value="Dúvidas">Dúvidas</option>
          <option value="Pedido personalizado">Pedido personalizado</option>
          <option value="Parcerias">Parcerias</option>
          <option value="Outros">Outros</option>
        </select>
      </div>
      <div class="form-group" style="grid-column: 1 / -1;">
        <label for="mensagem">Mensagem</label>
        <textarea id="mensagem" name="mensagem" rows="6" placeholder="Conte-nos como podemos ajudar" required></textarea>
      </div>
      <div class="form-group inline" style="grid-column: 1 / -1;">
        <input id="newsletter" name="newsletter" type="checkbox" value="1">
        <label for="newsletter">Quero receber novidades e promoções</label>
      </div>
      <button type="submit">Enviar</button>
    </form>
  </section>

  <footer class="footer">
    <p>Doceria do Amor Todos os direitos reservados.</p>
  </footer>
  <script src="<?php echo $BASE; ?>/js/script.js"></script>
</body>
</html>
