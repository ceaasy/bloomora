<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Bloomora'))</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @stack('styles')

</head>

<body class="guest-page">
    <div>
        <p class="guest-page-title"><span>@yield('page_title')</span></p>
        <div class="guest-outer-frame">
            @yield('content')
        </div>
    </div>
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
