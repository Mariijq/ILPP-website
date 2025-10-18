document.addEventListener('DOMContentLoaded', () => {
    const hamburger = document.querySelector('.hamburger');
    const mobileSidebar = document.querySelector('.mobile-sidebar');
    const closeMenuBtn = document.querySelector('.close-menu');

    // Open sidebar
    hamburger.addEventListener('click', () => {
        mobileSidebar.classList.add('active');
    });

    // Close sidebar
    closeMenuBtn.addEventListener('click', () => {
        mobileSidebar.classList.remove('active');
    });

    // Close sidebar when clicking outside
    document.addEventListener('click', e => {
        if (window.innerWidth <= 767 && !mobileSidebar.contains(e.target) && !hamburger.contains(e.target)) {
            mobileSidebar.classList.remove('active');
        }
    });

    // Optional: close sidebar when resizing window above mobile
    window.addEventListener('resize', () => {
        if (window.innerWidth > 767) {
            mobileSidebar.classList.remove('active');
        }
    });
});
