import './bootstrap';

(function () {
  const menu = document.getElementById('mobile-menu');
  const openBtn = document.getElementById('menu-open');
  const closeBtn = document.getElementById('menu-close');
  const backdrop = document.getElementById('menu-backdrop');
  const open = () => { menu.classList.remove('hidden'); document.body.classList.add('overflow-hidden'); };
  const close = () => { menu.classList.add('hidden'); document.body.classList.remove('overflow-hidden'); };
  openBtn.addEventListener('click', open);
  closeBtn.addEventListener('click', close);
  backdrop.addEventListener('click', close);
  menu.querySelectorAll('[data-nav]').forEach((a) => a.addEventListener('click', close));
  document.addEventListener('keydown', (e) => { if (e.key === 'Escape') close(); });
})();
