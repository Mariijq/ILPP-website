<header>
    <nav class="navbar">

        <!-- Logo -->
        <div class="navbar-section logo-section">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/Logo.png') }}" alt="ILPP Logo">
                <span>Institute for Leadership and Public Policy</span>
            </a>
        </div>

        <!-- Desktop Navigation Links -->
        <div class="navbar-section navlinks-section desktop-only">
            <ul class="nav-links ">
                <li><a href="{{ route('news') }}">News</a></li>
                <li class="dropdown">
                    <a href="#" class="dropbtn">Who We Are<i class="bi bi-caret-down-fill"></i></a>
                    <ul class="dropdown-content">
                        <li><a href="{{ route('about') }}">About ILPP</a></li>
                        <li><a href="{{ route('history') }}">History</a></li>
                        <li><a href="{{ route('what-we-do') }}">What we do</a></li>
                        <li><a href="{{ route('team') }}">Our Team</a></li>
                        <li><a href="{{ route('partners') }}">Our Partners</a></li>
                        <li><a href="{{ route('internal-docs') }}">Internal Documents</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('projects') }}">Projects</a></li>
                <li><a href="{{ route('publications') }}">Publications</a></li>
                <li><a href="{{ route('gallery') }}">Gallery</a></li>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>
            </ul>
        </div>
        <!-- Right: Search Button + Language -->
        <div class="navbar-section right-section">
            <!-- Search Button -->
            <button class="search-toggle" id="searchToggleBtn">
                <i class="bi bi-search"></i>
            </button>

            <!-- Language Switcher -->
            <div class="language-switcher">
                <select onchange="window.location.href=this.value">
                    <option value="/lang/en">EN</option>
                    <option value="/lang/al">AL</option>
                    <option value="/lang/mk">MK</option>
                </select>
            </div>
        </div>

        <!-- Search Overlay -->
        <div class="search-overlay">
            <div class="search-box">
                <button class="close-search">&times;</button>
                <form action="#" method="GET">
                    <input type="text" name="q" placeholder="Search..." required>
                    <button type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
        </div>


        <!-- Mobile Hamburger -->
        <div class="hamburger mobile-only">
            <i class="bi bi-list"></i>
        </div>
    </nav>

    <!-- Mobile Sidebar -->
    <div class="frontend-wrapper d-flex">
        <!-- Sidebar -->
        <aside class="frontend-sidebar">
            <div class="brand">
                <img src="{{ asset('images/Logo.png') }}" alt="Logo">
                <h2>Institute for Leadership and Public Policy</h2>
            </div>
            <!-- Search + Language on top for mobile -->
            <div class="mobile-sidebar-top mb-3">
                <button class="search-toggle" id="mobileSearchToggleBtn">
                    <i class="bi bi-search"></i>
                </button>


                <div class="language-switcher mt-2">
                    <select onchange="window.location.href=this.value">
                        <option value="/lang/en">EN</option>
                        <option value="/lang/al">AL</option>
                        <option value="/lang/mk">MK</option>
                    </select>
                </div>
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
