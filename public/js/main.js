document.addEventListener('DOMContentLoaded', () => {
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.querySelector('.nav-links');
    const closeMenuBtn = document.querySelector('.close-menu');
    const dropdowns = document.querySelectorAll('.nav-links .dropdown');

    hamburger.addEventListener('click', () => {
      navLinks.classList.add('active');
    });

    closeMenuBtn.addEventListener('click', () => {
      navLinks.classList.remove('active');
    });

    dropdowns.forEach(drop => {
      const btn = drop.querySelector('.dropbtn');
      const content = drop.querySelector('.dropdown-content');

      btn.addEventListener('click', e => {
        if (window.innerWidth <= 767) {
          e.preventDefault();
          content.classList.toggle('active');
        }
      });
    });

    document.addEventListener('click', e => {
      if (window.innerWidth <= 767 && !navLinks.contains(e.target) && !hamburger.contains(e.target)) {
        navLinks.classList.remove('active');
        document.querySelectorAll('.dropdown-content').forEach(dc => dc.classList.remove('active'));
      }
    });
});
