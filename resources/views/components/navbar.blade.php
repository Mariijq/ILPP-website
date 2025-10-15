<header>
    <nav class="navbar">
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/Logo.png') }}" alt="ILPP Logo">
                <span>Institute for Leadership and Public Policy</span>
            </a>
        </div>
        <ul class="nav-links">
            <li><button class="close-menu"><i class="bi bi-arrow-left"></i></button></li>
            <li><a href="{{ route('home') }}">NEWS</a></li>
            <li><a href="#">WHO WE ARE</a></li>
            <li><a href="#">PROJECTS</a></li>
            <li><a href="#">PUBLICATIONS</a></li>
            <li><a href="#">GALLERY</a></li>
            <li><a href="#">CONTACT US</a></li>
            <button id="openForm" class="join-btn">Join Us</button>
        </ul>
    </nav>
</header>
