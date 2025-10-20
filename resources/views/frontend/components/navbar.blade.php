<header>
    <nav class="navbar">

        <div class="hamburger">
            <i class="bi bi-list"></i>
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
        </ul>
    </nav>

    <!-- Mobile Sidebar -->
    <div class="frontend-wrapper d-flex">
        <!-- Sidebar -->
        <aside class="frontend-sidebar">
            <div class="brand">
                <img src="{{ asset('images/Logo.png') }}" alt="Logo">
                <h2>Institute for Leadership and Public Policy</h2>
            </div>

            <nav class="menu">

                <a href="{{ route('news') }}"><i class="bi bi-newspaper"> </i>NEWS</a>
                <!-- Collapsible Section -->
                <button class=" btn-toggle w-100 text-start collapsed" data-bs-toggle="collapse"
                    data-bs-target="#who-collapse" aria-expanded="false">
                    <i class="bi bi-people"> </i>
                    WHO WE ARE
                </button>
                <div class="collapse" id="who-collapse">
                    <ul class="list-unstyled ps-3">
                        <li><a href="{{ route('about') }}">About ILPP</a></li>
                        <li><a href="{{ route('history') }}">History</a></li>
                        <li><a href="{{ route('what-we-do') }}">What We Do</a></li>
                        <li> <a href="{{ route('team') }}">Team Members</a></li>
                        <li><a href="{{ route('partners') }}">Partners</a></li>
                        <li><a href="{{ route('internal-docs') }}">Internal Docs</a></li>
                    </ul>
                </div>

                <a href="{{ route('projects') }}"><i class="bi bi-archive"> </i>PROJECTS</a>
                <a href="{{ route('publications') }}"><i class="bi bi-journal"> </i>PUBLICATIONS</a>
                <a href="{{ route('gallery') }}"><i class="bi bi-images"> </i>GALLERY</a>


            </nav>
        </aside>
    </div>
    <div class="sidebar-overlay"></div>

</header>
