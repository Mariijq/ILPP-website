<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - ILPP Dashboard</title>
    <link rel="icon" href="{{ asset('images/Logo.png') }}" type="image/png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Admin CSS -->
    <link href="{{ asset('css/backend.css') }}" rel="stylesheet">
</head>

<body>

    <div class="backend-wrapper d-flex">
        <!-- Sidebar -->
        <aside class="backend-sidebar">
            <div class="brand">
                <img src="{{ asset('images/Logo.png') }}" alt="Logo">
                <h2>Institute for Leadership and Public Policy</h2>
            </div>

            <nav class="menu">
                <!-- Collapsible Section -->
                <button class="btn btn-toggle w-100 text-start collapsed" data-bs-toggle="collapse"
                    data-bs-target="#who-collapse" aria-expanded="false">
                    WHO WE ARE
                </button>
                <div class="collapse" id="who-collapse">
                    <ul class="list-unstyled ps-3">
                        <li><a href="{{ route('about.edit') }}">About ILPP</a></li>
                        <li><a href="{{ route('history.edit') }}">History</a></li>
                        <li><a href="{{ route('what-we-do.index') }}">What We Do</a></li>
                        <li> <a href="{{ route('team-members.index') }}">Team Members</a></li>
                        <li><a href="{{ route('partners.index') }}">Partners</a></li>
                        <li><a href="{{ route('internal-docs.index') }}">Internal Docs</a></li>
                    </ul>
                </div>

                <a href="{{ route('backend.dashboard') }}">Settings</a>
                <a href="{{ route('news.index') }}">News</a>
                <a href="{{ route('projects.index') }}">Projects</a>
                <a href="{{ route('publications.index') }}">Publications</a>
                <a href="{{ route('gallery.index') }}">Gallery</a>

            </nav>

            <div class="logout-form mt-auto">
                <form action="{{ route('backend.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="backend-main flex-grow-1">
            <header class="backend-header">
                <h1>@yield('title')</h1>
            </header>

            <section class="backend-content">
                @yield('content')
            </section>
        </main>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>

    {{-- DataTables styles --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

@if(isset($dataTable))
    {!! $dataTable->scripts() !!}
@endif

<script>
    // Wait until the DOM is loaded
    document.addEventListener("DOMContentLoaded", function() {
        if (document.getElementById('detailed_description')) {
            CKEDITOR.replace('detailed_description', { height: 300, removeButtons: '' });
        }
        if (document.getElementById('vision')) {
            CKEDITOR.replace('vision', { height: 150, removeButtons: '' });
        }
        if (document.getElementById('mission')) {
            CKEDITOR.replace('mission', { height: 150, removeButtons: '' });
        }
        if (document.getElementById('goals')) {
            CKEDITOR.replace('goals', { height: 150, removeButtons: '' });
        }
        if (document.getElementById('content')) {
            CKEDITOR.replace('content', {
                height: 300,
                removeButtons: ''
            });
        }
        
    });
</script>

</body>

</html>
