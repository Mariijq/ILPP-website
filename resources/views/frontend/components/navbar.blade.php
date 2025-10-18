<header>
    <nav class="navbar">
        <!-- Hamburger Menu -->
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <!-- Logo -->
        <div class="logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/Logo.png') }}" alt="ILPP Logo">
                <span>Institute for Leadership and Public Policy</span>
            </a>
        </div>

        <!-- Desktop Navigation Links -->
        <ul class="nav-links desktop-only">
            <li><a href="{{ route('news') }}">NEWS</a></li>
            <li class="dropdown">
                <a href="#" class="dropbtn">WHO WE ARE <i class="bi bi-caret-down-fill"></i></a>
                <ul class="dropdown-content">
                    <li><a href="{{ route('about') }}">About ILPP</a></li>
                    <li><a href="{{ route('history') }}">History</a></li>
                    <li><a href="{{ route('what-we-do') }}">What we do</a></li>
                    <li><a href="{{ route('team') }}">Our Team</a></li>
                    <li><a href="{{ route('partners') }}">Our Partners</a></li>
                    <li><a href="{{ route('internal-docs') }}">Internal Documents</a></li>
                </ul>
            </li>
            <li><a href="{{ route('projects') }}">PROJECTS</a></li>
            <li><a href="{{ route('publications') }}">PUBLICATIONS</a></li>
            <li><a href="{{ route('gallery') }}">GALLERY</a></li>
            <li><a href="{{ route('contact') }}">CONTACT US</a></li>
            <button id="openForm" class="join-btn">Join Us</button>
        </ul>
    </nav>

    <!-- Mobile Sidebar -->
    <ul class="nav-links mobile-sidebar">
        <li>
            <button class="close-menu"><i class="bi bi-x-lg"></i></button>
        </li>

        <li class="mb-1">
            <button class="btn btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#news-collapse"
                aria-expanded="false">
                NEWS
            </button>
            <div class="collapse" id="news-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{ route('news') }}" class="link-dark rounded">News</a></li>
                </ul>
            </div>
        </li>

        <li class="mb-1">
            <button class="btn btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#who-collapse"
                aria-expanded="false">
                WHO WE ARE
            </button>
            <div class="collapse" id="who-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{ route('about') }}" class="link-dark rounded">About ILPP</a></li>
                    <li><a href="{{ route('history') }}" class="link-dark rounded">History</a></li>
                    <li><a href="{{ route('what-we-do') }}" class="link-dark rounded">What we do</a></li>
                    <li><a href="{{ route('team') }}" class="link-dark rounded">Our Team</a></li>
                    <li><a href="{{ route('partners') }}" class="link-dark rounded">Our Partners</a></li>
                    <li><a href="{{ route('internal-docs') }}" class="link-dark rounded">Internal Documents</a></li>
                </ul>
            </div>
        </li>

        <!-- Repeat for Projects, Publications, Gallery, Contact -->
        <li class="mt-3">
            <button id="openForm" class="join-btn w-100">Join Us</button>
        </li>
    </ul>

</header>
