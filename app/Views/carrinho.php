<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Carrinho - Doceria do Amor</title>
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
  <section class="hero" role="img" aria-label="Doceria do Amor - Carrinho">
    <div class="hero-content">
      <h1 class="title-brand">Seu Carrinho</h1>
      <p class="subtitle">Revise seus itens antes de finalizar.</p>
    </div>
  </section>

  <section class="container section" style="max-width: 960px; margin: 40px auto;">
    <h1>Carrinho</h1>
    <?php $items = $_SESSION['cart'] ?? []; ?>
    <?php if (empty($items)) : ?>
      <p>Seu carrinho está vazio.</p>
      <p><a class="botao" href="<?php echo $BASE; ?>/produtos">Ver produtos</a></p>
    <?php else: ?>
      <table class="tabela">
        <thead>
          <tr>
            <th>Item</th>
            <th>Qtd</th>
            <th>Preço</th>
            <th>Total</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php $subtotal = 0; foreach ($items as $nome => $info): $total = $info['qtd'] * ($info['price'] ?? 0); $subtotal += $total; ?>
            <tr>
              <td><?php echo htmlspecialchars($nome); ?></td>
              <td><?php echo (int)$info['qtd']; ?></td>
              <td>R$ <?php echo number_format((float)($info['price'] ?? 0), 2, ',', '.'); ?></td>
              <td>R$ <?php echo number_format($total, 2, ',', '.'); ?></td>
              <td><a class="link-remover" href="<?php echo $BASE; ?>/carrinho/remover?item=<?php echo urlencode($nome); ?>">Remover</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <div class="resumo">
        <p><strong>Subtotal:</strong> R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></p>
        <a class="botao" href="<?php echo $BASE; ?>/produtos">Continuar comprando</a>
      </div>
    <?php endif; ?>
  </section>

  <footer class="footer">
    <p>Doceria do Amor Todos os direitos reservados.</p>
  </footer>
  <script src="<?php echo $BASE; ?>/js/script.js"></script>
</body>
</html>
