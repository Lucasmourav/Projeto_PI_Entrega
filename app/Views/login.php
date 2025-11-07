<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login / Cadastro - Doceria do Amor</title>
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

  <section class="hero" role="img" aria-label="Área de Login e Cadastro">
    <div class="hero-content">
      <h1 class="title-brand">Acesse sua conta</h1>
      <p class="subtitle">Entre ou cadastre-se para aproveitar nossas delícias.</p>
    </div>
  </section>

  <section class="contato">
    <div class="login-container">
      <?php if (!empty($erro_login)) : ?>
        <div class="alert error"><?php echo htmlspecialchars($erro_login); ?></div>
      <?php elseif (!empty($sucesso_cadastro)) : ?>
        <div class="alert success"><?php echo htmlspecialchars($sucesso_cadastro); ?></div>
      <?php endif; ?>

      <div class="forms-grid">
        <!-- Formulário de Login -->
        <form class="contato-form" method="post" action="<?php echo $BASE; ?>/login" novalidate>
          <h2>Entrar</h2>
          <div class="form-group">
            <label for="email_login">E-mail</label>
            <input id="email_login" name="email_login" type="email" placeholder="voce@exemplo.com" required autocomplete="email">
          </div>
          <div class="form-group">
            <label for="senha_login">Senha</label>
            <input id="senha_login" name="senha_login" type="password" placeholder="Sua senha" required autocomplete="current-password">
          </div>
          <button type="submit" name="acao" value="login">Entrar</button>
        </form>

        <!-- Formulário de Cadastro -->
        <form class="contato-form" method="post" action="<?php echo $BASE; ?>/login" novalidate>
          <h2>Criar Conta</h2>
          <div class="form-group">
            <label for="nome_cadastro">Nome completo</label>
            <input id="nome_cadastro" name="nome_cadastro" type="text" placeholder="Seu nome" required autocomplete="name">
          </div>
          <div class="form-group">
            <label for="email_cadastro">E-mail</label>
            <input id="email_cadastro" name="email_cadastro" type="email" placeholder="voce@exemplo.com" required autocomplete="email">
          </div>
          <div class="form-group">
            <label for="senha_cadastro">Senha</label>
            <input id="senha_cadastro" name="senha_cadastro" type="password" placeholder="Crie uma senha" required autocomplete="new-password">
          </div>
          <button type="submit" name="acao" value="cadastro">Cadastrar</button>
        </form>
      </div>
    </div>
  </section>

  <footer class="footer">
    <p>Doceria do Amor — Todos os direitos reservados.</p>
  </footer>

  <script src="<?php echo $BASE; ?>/js/script.js"></script>
</body>
</html>
