document.addEventListener('DOMContentLoaded', () => {
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.querySelector('.nav-links');
    const closeBtn = document.querySelector('.close-menu');

    hamburger.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        hamburger.classList.toggle('active');
    });

    closeBtn.addEventListener('click', () => {
        navLinks.classList.remove('active');
        hamburger.classList.remove('active');
    });

    document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', () => {
            navLinks.classList.remove('active');
            hamburger.classList.remove('active');
        });
    });

    const modal = document.getElementById("joinModal");
    const openBtn = document.getElementById("openForm");
    const modalCloseBtn = document.querySelector(".modal .close");

    if (openBtn && modal && modalCloseBtn) {
        openBtn.addEventListener('click', () => modal.style.display = "flex");
        modalCloseBtn.addEventListener('click', () => modal.style.display = "none");
        window.addEventListener('click', e => { if (e.target === modal) modal.style.display = "none"; });
    }
});
