<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Bloomora')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    @vite(['resources/sass/app.scss'])
    @yield('styles')
</head>

<body>

    <div class="d-flex flex-column" style="min-height: 100vh;">

        @include('layouts.inc.navbar_customer')

        <main class="p-4 flex-fill">
            @yield('content')
        </main>

        @include('layouts.inc.footer')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('scripts')

    @if (Session::has('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "Berhasil!",
                    text: "{{ Session::get('success') }}",
                    icon: "success"
                });
            });
        </script>
    @endif

</body>

</html>
