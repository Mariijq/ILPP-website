document.addEventListener('DOMContentLoaded', () => {
    const hamburger = document.querySelector('.hamburger');
    const sidebar = document.querySelector('.frontend-sidebar');
    const navbar = document.querySelector('.navbar');
    const closeBtn = document.querySelector('.close-menu');

    // Sidebar overlay
    let overlay = document.querySelector('.sidebar-overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.classList.add('sidebar-overlay');
        document.body.appendChild(overlay);
    }

    // Search overlay
    const searchOverlay = document.querySelector(".search-overlay");
    if (searchOverlay) searchOverlay.style.zIndex = 4000; // above sidebar overlay

    // ---------------- Sidebar Toggle ----------------
    hamburger.addEventListener('click', () => {
        sidebar.classList.add('active');
        overlay.classList.add('active');
        navbar.classList.add('sidebar-open');
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            navbar.classList.remove('sidebar-open');
        });
    }

    overlay.addEventListener('click', () => {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
        navbar.classList.remove('sidebar-open');
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 992) {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            navbar.classList.remove('sidebar-open');
        }
    });

    // ---------------- Search Overlay ----------------
    const desktopSearchBtn = document.getElementById("searchToggleBtn");
    const mobileSearchBtn = document.getElementById("mobileSearchToggleBtn");
    const closeSearchBtn = document.querySelector(".close-search");

    function openSearch() {
        // Collapse sidebar if open
        if (sidebar.classList.contains("active")) {
            sidebar.classList.remove("active");
            overlay.classList.remove("active");
            navbar.classList.remove("sidebar-open");
        }

        // Show search overlay
        searchOverlay.classList.add("active");

        // Ensure search input is focused immediately
        const input = searchOverlay.querySelector("input");
        if (input) input.focus();
    }

    function closeSearch() {
        searchOverlay.classList.remove("active");
    }

    if (desktopSearchBtn) desktopSearchBtn.addEventListener("click", openSearch);
    if (mobileSearchBtn) mobileSearchBtn.addEventListener("click", openSearch);
    if (closeSearchBtn) closeSearchBtn.addEventListener("click", closeSearch);

    searchOverlay.addEventListener("click", (e) => {
        if (e.target === searchOverlay) closeSearch();
    });
});
