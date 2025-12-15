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
                <span>{{ __('frontend.institute_name') }}</span>
            </a>
        </div>

        <!-- Desktop Navigation -->
        <div class="navbar-section navlinks-section desktop-only">
            <ul class="nav-links">
                <li><a href="{{ route('news') }}">{{ __('frontend.news') }}</a></li>

                <li class="dropdown">
                    <a href="#" class="dropbtn">{{ __('frontend.who_we_are') }} <i class="bi bi-caret-down-fill"></i></a>
                    <ul class="dropdown-content">
                        <li><a href="{{ route('about') }}">{{ __('frontend.about_ilpp') }}</a></li>
                        <li><a href="{{ route('history') }}">{{ __('frontend.history') }}</a></li>
                        <li><a href="{{ route('what-we-do') }}">{{ __('frontend.what_we_do') }}</a></li>
                        <li><a href="{{ route('team') }}">{{ __('frontend.our_team') }}</a></li>
                        <li><a href="{{ route('partners') }}">{{ __('frontend.our_partners') }}</a></li>
                        <li><a href="{{ route('documents') }}">{{ __('frontend.internal_documents') }}</a></li>
                    </ul>
                </li>

                <li><a href="{{ route('projects') }}">{{ __('frontend.projects') }}</a></li>
                <li><a href="{{ route('publications') }}">{{ __('frontend.publications') }}</a></li>
                <li><a href="{{ route('gallery') }}">{{ __('frontend.gallery') }}</a></li>
                <li><a href="{{ route('contact') }}">{{ __('frontend.contact') }}</a></li>
            </ul>

            <div class="navbar-section right-section">

                <!-- Search Button -->
                <button class="search-toggle" id="searchToggleBtn">
                    <i class="bi bi-search"></i>
                </button>

                <!-- Desktop Language Switcher -->
                <div class="language-switcher">
                    @php
                        $currentLocale = session('locale', app()->getLocale());
                    @endphp
                    <button class="current-lang">
                        @if($currentLocale == 'en')
                            <span class="fi fi-us"></span> En
                        @elseif($currentLocale == 'mk')
                            <span class="fi fi-mk"></span> Mk
                        @else
                            <span class="fi fi-al"></span> Al
                        @endif
                        <i class="bi bi-caret-down-fill"></i>
                    </button>

                    <ul class="lang-dropdown">
                        <li><a href="{{ route('switch.lang', 'en') }}"><span class="fi fi-us"></span> En</a></li>
                        <li><a href="{{ route('switch.lang', 'mk') }}"><span class="fi fi-mk"></span> Mk</a></li>
                        <li><a href="{{ route('switch.lang', 'al') }}"><span class="fi fi-al"></span> Al</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Search Overlay -->
        <div class="search-overlay" id="searchOverlay">
            <div class="search-box">
                <button type="button" class="close-search">&times;</button>

                <form action="{{ route('search') }}" method="GET">
                    <input type="text" name="q" placeholder="{{ __('frontend.search') }}" required>
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
                    <span>{{ __('frontend.institute_name') }}</span>
                </a>
            </div>

            <!-- MOBILE: Search + Language -->
            <div class="mobile-sidebar-top mb-3">
                <button class="search-toggle" id="mobileSearchToggleBtn">
                    <i class="bi bi-search"></i>
                </button>

                <div class="language-switcher mobile-lang-switcher mt-2">
                    @php
                        $currentLocale = session('locale', app()->getLocale());
                    @endphp
                    <button class="current-lang">
                        @if($currentLocale == 'en')
                            <span class="fi fi-us"></span> En
                        @elseif($currentLocale == 'mk')
                            <span class="fi fi-mk"></span> Mk
                        @else
                            <span class="fi fi-al"></span> Al
                        @endif
                        <i class="bi bi-caret-down-fill"></i>
                    </button>

                    <ul class="lang-dropdown">
                        <li><a href="{{ route('switch.lang', 'en') }}"><span class="fi fi-us"></span> En</a></li>
                        <li><a href="{{ route('switch.lang', 'mk') }}"><span class="fi fi-mk"></span> Mk</a></li>
                        <li><a href="{{ route('switch.lang', 'al') }}"><span class="fi fi-al"></span> Al</a></li>
                    </ul>
                </div>
            </div>

            <!-- MOBILE MENU -->
            <nav class="menu">
                <a href="{{ route('news') }}"><i class="bi bi-newspaper"></i> {{ __('frontend.news') }}</a>

                <button class="btn-toggle collapsed">
                    <i class="bi bi-people"></i> {{ __('frontend.who_we_are') }}
                </button>

                <div class="collapse">
                    <ul>
                        <li><a href="{{ route('about') }}">{{ __('frontend.about_ilpp') }}</a></li>
                        <li><a href="{{ route('history') }}">{{ __('frontend.history') }}</a></li>
                        <li><a href="{{ route('what-we-do') }}">{{ __('frontend.what_we_do') }}</a></li>
                        <li><a href="{{ route('team') }}">{{ __('frontend.our_team') }}</a></li>
                        <li><a href="{{ route('partners') }}">{{ __('frontend.our_partners') }}</a></li>
                        <li><a href="{{ route('documents') }}">{{ __('frontend.internal_documents') }}</a></li>
                    </ul>
                </div>

                <a href="{{ route('projects') }}"><i class="bi bi-archive"></i> {{ __('frontend.projects') }}</a>
                <a href="{{ route('publications') }}"><i class="bi bi-journal"></i> {{ __('frontend.publications') }}</a>
                <a href="{{ route('gallery') }}"><i class="bi bi-images"></i> {{ __('frontend.gallery') }}</a>
                <a href="{{ route('contact') }}"><i class="bi bi-telephone"></i> {{ __('frontend.contact_us') }}</a>
            </nav>
        </aside>

        <div class="sidebar-overlay" id="sidebarOverlay"></div>
    </div>
</header>
