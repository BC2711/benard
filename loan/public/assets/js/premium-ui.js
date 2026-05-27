document.addEventListener('DOMContentLoaded', () => {
  const nav = document.querySelector('[data-premium-nav]');
  const menuButton = document.querySelector('[data-mobile-menu-button]');
  const mobilePanel = document.querySelector('[data-mobile-menu]');

  const setNavState = () => {
    if (!nav) return;
    nav.classList.toggle('is-scrolled', window.scrollY > 24);
  };

  setNavState();
  window.addEventListener('scroll', setNavState, { passive: true });

  if (menuButton && mobilePanel) {
    const setOpen = (open) => {
      menuButton.setAttribute('aria-expanded', open ? 'true' : 'false');
      mobilePanel.classList.toggle('is-open', open);
      document.body.classList.toggle('overflow-hidden', open);
    };

    menuButton.addEventListener('click', () => {
      setOpen(menuButton.getAttribute('aria-expanded') !== 'true');
    });

    mobilePanel.querySelectorAll('a').forEach((link) => {
      link.addEventListener('click', () => setOpen(false));
    });

    window.addEventListener('resize', () => {
      if (window.innerWidth >= 1024) setOpen(false);
    });
  }

  document.querySelectorAll('body.premium-site section > .container, body.premium-site section > .premium-shell').forEach((item) => {
    if (!item.classList.contains('premium-reveal') && !item.classList.contains('premium-stagger')) {
      item.classList.add('premium-reveal');
    }
  });

  const revealItems = document.querySelectorAll('.premium-reveal, .premium-stagger');
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target);
      });
    }, { threshold: 0.14, rootMargin: '0px 0px -60px 0px' });

    revealItems.forEach((item) => observer.observe(item));
  } else {
    revealItems.forEach((item) => item.classList.add('is-visible'));
  }
});
