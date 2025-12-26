@php
    $contact = \App\Models\ContactInfo::first();
    $currentLocale = session('locale', app()->getLocale());
@endphp

<header>
    <nav class="navbar">

        <!-- Top Navbar -->
        <div class="top-navbar">
            <div class="social-media-links">
                @if ($contact?->facebook)
                    <a href="{{ $contact->facebook }}"><i class="bi bi-facebook"></i></a>
                @endif
                @if ($contact?->instagram)
                    <a href="{{ $contact->instagram }}"><i class="bi bi-instagram"></i></a>
                @endif
                @if ($contact?->linkedin)
                    <a href="{{ $contact->linkedin }}"><i class="bi bi-linkedin"></i></a>
                @endif
                @if ($contact?->youtube)
                    <a href="{{ $contact->youtube }}"><i class="bi bi-youtube"></i></a>
                @endif
            </div>

            <div class="top-navbar-right">
                <button class="search-toggle" id="searchToggleBtn">
                    <i class="bi bi-search"></i>
                </button>

                <div class="language-switcher">
                    <button class="current-lang">
                        @if ($currentLocale == 'en')
                            <span class="fi fi-us"></span> {{ __('frontend.en') }}
                        @elseif($currentLocale == 'mk')
                            <span class="fi fi-mk"></span> {{ __('frontend.mk') }}
                        @else
                            <span class="fi fi-al"></span> {{ __('frontend.al') }}
                        @endif
                        <i class="bi bi-caret-down-fill"></i>
                    </button>

                    <ul class="lang-dropdown">
                        <li><a href="{{ route('switch.lang', 'en') }}"><span class="fi fi-us"></span> {{ __('frontend.en') }}</a></li>
                        <li><a href="{{ route('switch.lang', 'mk') }}"><span class="fi fi-mk"></span> {{ __('frontend.mk') }}</a></li>
                        <li><a href="{{ route('switch.lang', 'al') }}"><span class="fi fi-al"></span> {{ __('frontend.al') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Bottom Navbar -->
        <div class="bottom-navbar">
            <div class="hamburger"> <i class="bi bi-list"></i> </div>
            <div class="logo-section"> 
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/Logo.png') }}">
                    <span>{{ __('frontend.institute_name') }}</span>
                </a> 
            </div>
            <div class="navlinks-section">
                <ul>
                    <li class="dropdown">
                        <a href="#" class="dropbtn">{{ __('frontend.us') }} <i class="bi bi-caret-down-fill"></i></a>
                        <ul class="dropdown-content">
                            <li><a href="{{ route('about') }}">{{ __('frontend.vision_mission_purpose') }}</a></li>
                            <li><a href="{{ route('team') }}">{{ __('frontend.team') }}</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropbtn">{{ __('frontend.projects') }} <i class="bi bi-caret-down-fill"></i></a>
                        <ul class="dropdown-content">
                            <li><a href="{{ route('projects.current') }}">{{ __('frontend.current_projects') }}</a></li>
                            <li><a href="{{ route('projects.completed') }}">{{ __('frontend.completed_projects') }}</a></li>
                        </ul>
                    </li>

                    <li><a href="{{ route('publications') }}">{{ __('frontend.publications') }}</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropbtn">{{ __('frontend.partners') }} <i class="bi bi-caret-down-fill"></i></a>
                        <ul class="dropdown-content">
                            <li><a href="{{ route('partners') }}">{{ __('frontend.Funding_&_Support') }}</a></li>
                            <li><a href="{{ route('supporters') }}">{{ __('frontend.Strategic_Partners') }}</a></li>
                        </ul>
                    </li>

                    <li><a href="{{ route('documents') }}">{{ __('frontend.bodies') }}</a></li>
                    <li><a href="{{ route('news') }}">{{ __('frontend.news_media') }}</a></li>
                    <li><a href="{{ route('voices') }}">{{ __('frontend.voices') }}</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropbtn">{{ __('frontend.contact_documents') }} <i class="bi bi-caret-down-fill"></i></a>
                        <ul class="dropdown-content">
                            <li><a href="{{ route('contact') }}">{{ __('frontend.contact') }}</a></li>
                            <li><a href="{{ route('documents') }}">{{ __('frontend.documents') }}</a></li>
                        </ul>
                    </li>
                </ul>
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

    <!-- Mobile Sidebar -->
    <div class="frontend-wrapper d-flex">
        <aside class="frontend-sidebar" id="mobileSidebar">
            <div class="brand">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/Logo.png') }}" alt="Logo">
                    <span>{{ __('frontend.institute_name') }}</span>
                </a>
            </div>

            <div class="mobile-sidebar-top mb-3">
                <button class="search-toggle" id="mobileSearchToggleBtn">
                    <i class="bi bi-search"></i>
                </button>

                <div class="language-switcher mobile-lang-switcher mt-2">
                    <button class="current-lang">
                        @if ($currentLocale == 'en')
                            <span class="fi fi-us"></span> {{ __('frontend.en') }}
                        @elseif($currentLocale == 'mk')
                            <span class="fi fi-mk"></span> {{ __('frontend.mk') }}
                        @else
                            <span class="fi fi-al"></span> {{ __('frontend.al') }}
                        @endif
                        <i class="bi bi-caret-down-fill"></i>
                    </button>

                    <ul class="lang-dropdown">
                        <li><a href="{{ route('switch.lang', 'en') }}"><span class="fi fi-us"></span> {{ __('frontend.en') }}</a></li>
                        <li><a href="{{ route('switch.lang', 'mk') }}"><span class="fi fi-mk"></span> {{ __('frontend.mk') }}</a></li>
                        <li><a href="{{ route('switch.lang', 'al') }}"><span class="fi fi-al"></span> {{ __('frontend.al') }}</a></li>
                    </ul>
                </div>
            </div>

            <nav class="menu">
                <button class="btn-toggle collapsed"><i class="bi bi-people"></i> {{ __('frontend.us') }}</button>
                <div class="collapse">
                    <ul>
                        <li><a href="{{ route('about') }}">{{ __('frontend.vision_mission_purpose') }}</a></li>
                        <li><a href="{{ route('team') }}">{{ __('frontend.team') }}</a></li>
                    </ul>
                </div>

                <button class="btn-toggle collapsed"><i class="bi bi-archive"></i> {{ __('frontend.projects') }}</button>
                <div class="collapse">
                    <ul>
                        <li><a href="{{ route('projects.current') }}">{{ __('frontend.current_projects') }}</a></li>
                        <li><a href="{{ route('projects.completed') }}">{{ __('frontend.completed_projects') }}</a></li>
                    </ul>
                </div>

                <a href="{{ route('publications') }}"><i class="bi bi-journal"></i> {{ __('frontend.publications') }}</a>

                <button class="btn-toggle collapsed"><i class="bi bi-person-raised-hand"></i> {{ __('frontend.partners') }}</button>
                <div class="collapse">
                    <ul>
                        <li><a href="{{ route('partners') }}">{{ __('frontend.Funding_&_Support') }}</a></li>
                        <li><a href="{{ route('supporters') }}">{{ __('frontend.Strategic_Partners') }}</a></li>
                    </ul>
                </div>

                <a href="{{ route('documents') }}"><i class="bi bi-diagram-3"></i> {{ __('frontend.bodies') }}</a>
                <a href="{{ route('news') }}"><i class="bi bi-newspaper"></i> {{ __('frontend.news_media') }}</a>
                <a href="{{ route('voices') }}"><i class="bi bi-chat-left-quote"></i> {{ __('frontend.voices') }}</a>

                <button class="btn-toggle collapsed"><i class="bi bi-telephone"></i> {{ __('frontend.contact_documents') }}</button>
                <div class="collapse">
                    <ul>
                        <li><a href="{{ route('contact') }}">{{ __('frontend.contact') }}</a></li>
                        <li><a href="{{ route('documents') }}">{{ __('frontend.documents') }}</a></li>
                    </ul>
                </div>
            </nav>
        </aside>

        <div class="sidebar-overlay" id="sidebarOverlay"></div>
    </div>
</header>
