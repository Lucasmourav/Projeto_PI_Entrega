// Espera todo o conteúdo da página ser carregado antes de executar o código
document.addEventListener('DOMContentLoaded', () => {

  // Seleciona todos os links que começam com "#" (links internos da página)
  const internalLinks = document.querySelectorAll('a[href^="#"]');

  // Para cada link interno encontrado
  internalLinks.forEach(link => {

    // Adiciona um evento de clique ao link
    link.addEventListener('click', (e) => {

      // Pega o valor do atributo href do link
      const href = link.getAttribute('href');

      // Se não tiver href ou for apenas "#", não faz nada
      if (!href || href === '#') return;

      // Procura o elemento de destino correspondente ao href
      const target = document.querySelector(href);

      // Se o elemento de destino existir
      if (target) {
        e.preventDefault(); // Impede o comportamento padrão do link
        target.scrollIntoView({ behavior: 'smooth', block: 'start' }); // Faz rolagem suave até o alvo
      }
    });
  });


  // Seleciona o formulário com a classe .contato-form
  const form = document.querySelector('.contato-form');

  // Verifica se o formulário existe na página
  if (form) {

    // Adiciona um evento de envio (submit) ao formulário
    form.addEventListener('submit', (e) => {

      // Pega o primeiro campo de texto ou e-mail dentro do formulário
      const input = form.querySelector('input[type="text"], input[type="email"]');

      // Pega o valor do campo e remove espaços extras
      const value = (input?.value || '').trim();

      // Expressão regular que verifica se o e-mail é válido
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      // Se o e-mail não for válido
      if (!emailRegex.test(value)) {
        e.preventDefault(); // Impede o envio do formulário
        alert('Por favor, informe um e-mail válido.'); // Mostra mensagem de alerta
        input?.focus(); // Coloca o cursor de volta no campo de entrada
      }
    });
  }
});

