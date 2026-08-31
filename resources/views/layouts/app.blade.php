<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bloomora Admin')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @vite(['resources/sass/app.scss'])
    @stack('styles')
</head>

<body>

    <div class="d-flex">

        @include('layouts.inc.sidebar')

        <div class="flex-fill d-flex flex-column" style="min-height: 100vh;">

            @include('layouts.inc.navbar_admin')

            <main class="p-4 flex-fill">
                @yield('content')
            </main>

            @include('layouts.inc.footer')

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')

</body>

</html>
