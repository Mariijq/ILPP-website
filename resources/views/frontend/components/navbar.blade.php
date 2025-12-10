<header>
    <nav class="navbar">

        <!-- Mobile Hamburger -->
        <div class="hamburger mobile-only" id="hamburgerBtn">
            <i class="bi bi-list"></i>
        </div>

        <!-- Logo -->
        <div class="navbar-section logo-section">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/Logo.png') }}" alt="ILPP Logo">
                <span>Institute for Leadership and Public Policy</span>
            </a>
        </div>

        <!-- Desktop Navigation -->
        <div class="navbar-section navlinks-section desktop-only">
            <ul class="nav-links">
                <li><a href="{{ route('news') }}">News</a></li>

                <li class="dropdown">
                    <a href="#" class="dropbtn">Who We Are <i class="bi bi-caret-down-fill"></i></a>
                    <ul class="dropdown-content">
                        <li><a href="{{ route('about') }}">About ILPP</a></li>
                        <li><a href="{{ route('history') }}">History</a></li>
                        <li><a href="{{ route('what-we-do') }}">What we do</a></li>
                        <li><a href="{{ route('team') }}">Our Team</a></li>
                        <li><a href="{{ route('partners') }}">Our Partners</a></li>
                        <li><a href="{{ route('documents') }}">Internal Documents</a></li>
                    </ul>
                </li>

                <li><a href="{{ route('projects') }}">Projects</a></li>
                <li><a href="{{ route('publications') }}">Publications</a></li>
                <li><a href="{{ route('gallery') }}">Gallery</a></li>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>
            </ul>

            <div class="navbar-section right-section">

                <!-- Search Button -->
                <button class="search-toggle" id="searchToggleBtn">
                    <i class="bi bi-search"></i>
                </button>

                <!-- Desktop Language Switcher -->
                <div class="language-switcher">
                    <button class="current-lang">
                        <span class="fi fi-us"></span> EN <i class="bi bi-caret-down-fill"></i>
                    </button>
                    <ul class="lang-dropdown">
                        <li onclick="window.location.href='/lang/en'"><span class="fi fi-us"></span> EN</li>
                        <li onclick="window.location.href='/lang/al'"><span class="fi fi-al"></span> AL</li>
                        <li onclick="window.location.href='/lang/mk'"><span class="fi fi-mk"></span> MK</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Search Overlay -->
        <div class="search-overlay" id="searchOverlay">
            <div class="search-box">
                <button type="button" class="close-search">&times;</button>

                <form action="{{ route('search') }}" method="GET">
                    <input type="text" name="q" placeholder="Search..." required>
                    <button type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
        </div>

    </nav>

    <!-- MOBILE SIDEBAR -->
    <div class="frontend-wrapper d-flex">

        <aside class="frontend-sidebar" id="mobileSidebar">

            <!-- Brand -->
            <div class="brand">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/Logo.png') }}" alt="Logo">
                    <span>Institute for Leadership and Public Policy</span>
                </a>
            </div>

            <!-- MOBILE: Search + Language -->
            <div class="mobile-sidebar-top mb-3">

                <button class="search-toggle" id="mobileSearchToggleBtn">
                    <i class="bi bi-search"></i>
                </button>

                <div class="language-switcher mobile-lang-switcher mt-2">
                    <button class="current-lang">
                        <span class="fi fi-us"></span> EN <i class="bi bi-caret-down-fill"></i>
                    </button>
                    <ul class="lang-dropdown">
                        <li onclick="window.location.href='/lang/en'"><span class="fi fi-us"></span> EN</li>
                        <li onclick="window.location.href='/lang/al'"><span class="fi fi-al"></span> AL</li>
                        <li onclick="window.location.href='/lang/mk'"><span class="fi fi-mk"></span> MK</li>
                    </ul>
                </div>

            </div>

            <!-- MOBILE MENU -->
            <nav class="menu">

                <a href="{{ route('news') }}"><i class="bi bi-newspaper"></i> News</a>

                <!-- Collapsible Who We Are -->
                <button class="btn-toggle collapsed">
                    <i class="bi bi-people"></i> Who We Are
                </button>

                <div class="collapse">
                    <ul>
                        <li><a href="{{ route('about') }}">About ILPP</a></li>
                        <li><a href="{{ route('history') }}">History</a></li>
                        <li><a href="{{ route('what-we-do') }}">What We Do</a></li>
                        <li><a href="{{ route('team') }}">Team Members</a></li>
                        <li><a href="{{ route('partners') }}">Partners</a></li>
                        <li><a href="{{ route('documents') }}">Internal Docs</a></li>
                    </ul>
                </div>

                <a href="{{ route('projects') }}"><i class="bi bi-archive"></i> Projects</a>
                <a href="{{ route('publications') }}"><i class="bi bi-journal"></i> Publications</a>
                <a href="{{ route('gallery') }}"><i class="bi bi-images"></i> Gallery</a>
                <a href="{{ route('contact') }}"><i class="bi bi-telephone"></i> Contact Us</a>

            </nav>

        </aside>

        <!-- DARK OVERLAY -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

    </div>
</header>
