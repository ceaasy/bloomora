<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Bloomora'))</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @stack('styles')

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #FAF3F0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 12px;
        }

        .guest-page-title {
            text-align: center;
            font-size: 1rem;
            letter-spacing: 2px;
            font-weight: 700;
            color: #4A3F3F;
            margin-bottom: 24px;
            text-transform: uppercase;
        }

        .guest-outer-frame {
            border: 1px solid #E8D5D5;
            border-radius: 12px;
            padding: 24px;
            background: #FFFFFF;
            box-shadow: 0 4px 20px rgba(214, 51, 108, 0.08);
            width: 600px;
            max-width: 100%;
        }

        .guest-card {
            border-radius: 16px;
            padding: 36px;
            width: 100%;
            max-width: 500px;
        }

        .card-pink {
            background: #FBE9EE;
        }

        .card-maroon {
            background: #F3E1E3;
        }

        .btn-bloomora-pink {
            background-color: #D6336C;
            border-color: #D6336C;
        }

        .btn-bloomora-pink:hover {
            background-color: #B92A5B;
            border-color: #B92A5B;
        }

        .btn-bloomora-maroon {
            background-color: #9C2B3A;
            border-color: #9C2B3A;
        }

        .btn-bloomora-maroon:hover {
            background-color: #7E2230;
            border-color: #7E2230;
        }

        .link-pink {
            color: #D6336C;
            font-weight: 600;
        }

        .link-maroon {
            color: #9C2B3A;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div>
        <p class="guest-page-title">@yield('page_title')</p>
        <div class="guest-outer-frame">
            @yield('content')
        </div>
    </div>
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
