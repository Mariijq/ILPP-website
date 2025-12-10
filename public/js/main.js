document.addEventListener('DOMContentLoaded', () => {
    const hamburger = document.querySelector('.hamburger');
    const sidebar = document.querySelector('.frontend-sidebar');
    const navbar = document.querySelector('.navbar');
    let overlay = document.querySelector('.sidebar-overlay');

    // Create overlay if not exists
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.classList.add('sidebar-overlay');
        document.body.appendChild(overlay);
    }

    // ---------------- Sidebar Toggle ----------------
    hamburger.addEventListener('click', () => {
        sidebar.classList.add('active');
        overlay.classList.add('active');
        navbar.classList.add('sidebar-open');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
        navbar.classList.remove('sidebar-open');
        closeSearch();
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 992) {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            navbar.classList.remove('sidebar-open');
        }
    });

    // Sidebar dropdown toggles
    document.querySelectorAll('.btn-toggle').forEach(btn => {
        btn.addEventListener('click', () => {
            const collapse = btn.nextElementSibling;
            collapse.classList.toggle('show');
            btn.classList.toggle('collapsed');
        });
    });

    // ---------------- Search Overlay ----------------
    const searchOverlay = document.querySelector(".search-overlay");
    const desktopSearchBtn = document.getElementById("searchToggleBtn");
    const mobileSearchBtn = document.getElementById("mobileSearchToggleBtn");
    const closeSearchBtn = document.querySelector(".close-search");

    function openSearch() {
        sidebar.classList.remove("active");
        overlay.classList.remove("active");
        navbar.classList.remove("sidebar-open");
        searchOverlay.classList.add("active");
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
    // Desktop language switcher toggle
    // Language switcher toggle (desktop + mobile)
    document.querySelectorAll('.language-switcher').forEach(langSwitcher => {
        const currentLangBtn = langSwitcher.querySelector('.current-lang');

        if (currentLangBtn) {
            currentLangBtn.addEventListener('click', (e) => {
                e.stopPropagation(); // Prevent closing immediately
                langSwitcher.classList.toggle('show');
            });
        }
    });

    // Close all language dropdowns when clicking outside
    document.addEventListener('click', (e) => {
        document.querySelectorAll('.language-switcher').forEach(langSwitcher => {
            if (!langSwitcher.contains(e.target)) {
                langSwitcher.classList.remove('show');
            }
        });
    });

});
