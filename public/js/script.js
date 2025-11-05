 document.addEventListener('DOMContentLoaded', () => {

   const internalLinks = document.querySelectorAll('a[href^="#"]');
   internalLinks.forEach(link => {
     link.addEventListener('click', (e) => {
       const href = link.getAttribute('href');
       if (!href || href === '#') return;
       const target = document.querySelector(href);
       if (target) {
         e.preventDefault();
         target.scrollIntoView({ behavior: 'smooth', block: 'start' });
       }
     });
   });

  
   const form = document.querySelector('.contato-form');
   if (form) {
     form.addEventListener('submit', (e) => {
       const input = form.querySelector('input[type="text"], input[type="email"]');
       const value = (input?.value || '').trim();
       const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
       if (!emailRegex.test(value)) {
         e.preventDefault();
         alert('Por favor, informe um e-mail válido.');
         input?.focus();
       }
     });
   }
 });
