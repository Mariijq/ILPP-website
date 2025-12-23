<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - ILPP Dashboard</title>
    <link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>

<body>

    <!-- Sidebar Toggle Button -->
    <div class="hamburger mobile-only d-flex">
        <i class="bi bi-list"></i>
    </div>

    <div class="backend-wrapper d-flex">

        <!-- Sidebar -->
        <aside class="backend-sidebar">
            <div class="brand">
                <img src="{{ asset('images/Logo.png') }}" alt="Logo">
                <h2>Institute for Leadership and Public Policy</h2>
            </div>

            <nav class="menu">

                <button class="btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#collapse-home">
                    Home
                </button>
                <div class="collapse" id="collapse-home">
                    <ul class="list-unstyled ps-3">
                        <li><a href="{{ route('testimonials.index') }}">Testimonials</a></li>
                        <li><a href="{{ route('slides.index') }}">Slider</a></li>
                    </ul>
                </div>

                <button class="btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#collapse-who">
                    Who We Are
                </button>
                <div class="collapse" id="collapse-who">
                    <ul class="list-unstyled ps-3">
                        <li><a href="{{ route('about.edit') }}">About ILPP</a></li>
                        <li><a href="{{ route('history.edit') }}">History</a></li>
                        <li><a href="{{ route('what-we-do.index') }}">What We Do</a></li>
                        <li><a href="{{ route('team-members.index') }}">Team Members</a></li>
                        <li><a href="{{ route('partners.index') }}">Partners</a></li>
                        <li><a href="{{ route('documents.index') }}">Internal Docs</a></li>
                    </ul>
                </div>

                <a href="{{ route('backend.dashboard') }}">Settings</a>
                <a href="{{ route('news.index') }}">News</a>
                <a href="{{ route('projects.index') }}">Projects</a>
                <a href="{{ route('publications.index') }}">Publications</a>
                <a href="{{ route('gallery.index') }}">Gallery</a>
                <a href="{{ route('contact-info.index') }}">Contact Info</a>
                <a href="{{ route('contact-messages.index') }}">Contact Messages</a>
            </nav>

            <div class="logout-form mt-auto">
                <form action="{{ route('backend.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </aside>

        <!-- Main -->
        <main class="backend-main flex-grow-1">
            <header class="backend-header">
                <h1>@yield('title')</h1>
            </header>

            <section class="backend-content">
                @yield('content')
            </section>
        </main>
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Sidebar + CKEditor -->
    <script>
        $(document).ready(function () {

            const $hamburger = $('.hamburger');
            const $sidebar = $('.backend-sidebar');
            const $main = $('.backend-main');

            $hamburger.on('click', function () {
                $sidebar.toggleClass('active');
                $main.toggleClass('shifted');
                $hamburger.toggle(!$sidebar.hasClass('active'));
            });

            $(document).on('click', function (e) {
                if ($sidebar.hasClass('active') &&
                    !$(e.target).closest($sidebar).length &&
                    !$(e.target).closest($hamburger).length) {

                    $sidebar.removeClass('active');
                    $main.removeClass('shifted');
                    $hamburger.show();
                }
            });

            /* ================= CKEDITOR INIT ================= */
            document.querySelectorAll('.ckeditor').forEach(function (el) {
                CKEDITOR.replace(el.id, {
                    height: 300,
                    removeButtons: ''
                });
            });

            /* ================= TOASTR ================= */
            @if (session('success')) toastr.success("{{ session('success') }}"); @endif
            @if (session('error')) toastr.error("{{ session('error') }}"); @endif
            @if (session('warning')) toastr.warning("{{ session('warning') }}"); @endif
            @if (session('info')) toastr.info("{{ session('info') }}"); @endif

            /* ================= DELETE CONFIRM ================= */
            $(document).on('click', '.delete-form button', function (e) {
                e.preventDefault();
                const form = $(this).closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action cannot be undone!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#26a6a0',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(result => {
                    if (result.isConfirmed) form.submit();
                });
            });

        });
    </script>

    @if (isset($dataTable))
        {!! $dataTable->scripts() !!}
    @endif

</body>
</html>
