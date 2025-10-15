<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Institute for Leadership and Public Policy (ILPP)')</title>

    @vite(['resources/css/style.css', 'resources/js/main.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <div class="page-container">
        @include('components.navbar')

        <main>
            @yield('content')
        </main>

        @include('components.footer')
    </div>
</body>
</html>
