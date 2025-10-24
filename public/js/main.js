document.addEventListener('DOMContentLoaded', () => {
    const hamburger = document.querySelector('.hamburger');
    const sidebar = document.querySelector('.frontend-sidebar');

    // Close button inside sidebar (optional)
    const closeBtn = document.querySelector('.close-menu');

    // Overlay
    let overlay = document.querySelector('.sidebar-overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.classList.add('sidebar-overlay');
        document.body.appendChild(overlay);
    }

    // Open sidebar
    hamburger.addEventListener('click', () => {
        sidebar.classList.add('active');
        overlay.classList.add('active');
    });

    // Close sidebar via close button
    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });
    }

    // Close sidebar by clicking outside
    overlay.addEventListener('click', () => {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
    });

    // Auto-hide sidebar when resizing to desktop
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 992) {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        }
    });

    // Open search bar
    const desktopSearchBtn = document.getElementById("searchToggleBtn");
    const mobileSearchBtn = document.getElementById("mobileSearchToggleBtn");
    const searchOverlay = document.querySelector(".search-overlay");
    const closeSearchBtn = document.querySelector(".close-search");

    function openSearch() {
        searchOverlay.classList.add("active");
    }

    function closeSearch() {
        searchOverlay.classList.remove("active");
    }

    // Desktop button
    if (desktopSearchBtn) desktopSearchBtn.addEventListener("click", openSearch);

    // Mobile button
    if (mobileSearchBtn) mobileSearchBtn.addEventListener("click", openSearch);

    // Close button
    if (closeSearchBtn) closeSearchBtn.addEventListener("click", closeSearch);

    // Close on overlay click
    searchOverlay.addEventListener("click", (e) => {
        if (e.target === searchOverlay) closeSearch();
    });
});
