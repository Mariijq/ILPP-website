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

        <!-- Navigation Links -->
        <ul class="nav-links">
            <li>
                <button class="close-menu">
                    <i class="bi bi-arrow-left"></i>
                </button>
            </li>

            <li><a href="{{ route('news') }}">NEWS</a></li>

            <li class="dropdown">
                <a href="#" class="dropbtn">
                    WHO WE ARE <i class="bi bi-caret-down-fill"></i>
                </a>
                <ul class="dropdown-content">
                    <li><a href="{{ route('about') }}">About ILPP</a></li>
                    <li><a href="{{ route('history') }}">History</a></li>
                    <li><a href="{{ route('what-we-do') }}">What we do</a></li>
                    <li><a href="{{ route('team') }}">Our Team</a></li>
                    <li><a href="{{ route('partners') }}">Our Partners</a></li>
                    <li><a href="{{ route('internal-docs') }}">Internal documents</a></li>
                </ul>
            </li>

            <li><a href="{{ route('projects') }}">PROJECTS</a></li>
            <li><a href="{{ route('publications') }}">PUBLICATIONS</a></li>
            <li><a href="{{ route('gallery') }}">GALLERY</a></li>
            <li><a href="{{ route('contact') }}">CONTACT US</a></li>

            <button id="openForm" class="join-btn">Join Us</button>
        </ul>
    </nav>
</header>
