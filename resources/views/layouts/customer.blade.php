<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Bloomora')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @vite(['resources/sass/app.scss'])
    @stack('styles')
    <style>
        .btn-bloomora-pink,
        .btn.text-white[style*="D6336C"] {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-bloomora-pink:hover,
        .btn.text-white[style*="D6336C"]:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(214, 51, 108, 0.35);
        }

        .btn-bloomora-pink:active,
        .btn.text-white[style*="D6336C"]:active {
            transform: translateY(-1px);
        }
    </style>
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

    @stack('scripts')

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
