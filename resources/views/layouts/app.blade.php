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
            font-family: 'Nunito', sans-serif;
            background: #FAF3F0;
        }

        .navbar-bloomora {
            background: #FFFFFF;
            border-bottom: 1px solid #E8D5D5;
        }

        .navbar-bloomora .navbar-brand {
            font-weight: 700;
            color: #D6336C;
        }

        .navbar-bloomora.navbar-admin .navbar-brand {
            color: #9C2B3A;
        }

        .page-content {
            max-width: 900px;
            margin: 32px auto;
            padding: 0 16px;
        }

        .card-bloomora {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(214, 51, 108, 0.08);
        }

        .btn-bloomora-pink {
            background-color: #D6336C;
            border-color: #D6336C;
            color: #fff;
        }

        .btn-bloomora-pink:hover {
            background-color: #B92A5B;
            border-color: #B92A5B;
            color: #fff;
        }

        .btn-bloomora-maroon {
            background-color: #9C2B3A;
            border-color: #9C2B3A;
            color: #fff;
        }

        .btn-bloomora-maroon:hover {
            background-color: #7E2230;
            border-color: #7E2230;
            color: #fff;
        }
    </style>
</head>

<body>

    @php
        $isCustomer = Auth::guard('customer')->check();
        $isAdmin = Auth::guard('web')->check();
        $navClass = $isAdmin ? 'navbar-admin' : '';
    @endphp

    <nav class="navbar navbar-expand-md navbar-bloomora {{ $navClass }} shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ $isAdmin ? route('admin.dashboard') : url('/') }}">Bloomora</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto align-items-md-center">
                    @if ($isCustomer)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('customer.profile.edit') }}">
                                {{ Auth::guard('customer')->user()->name }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('customer.logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-secondary ms-2">Logout</button>
                            </form>
                        </li>
                    @elseif ($isAdmin)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.profile.edit') }}">
                                {{ Auth::guard('web')->user()->name }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-secondary ms-2">Logout</button>
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <main class="page-content">
        @yield('content')
    </main>

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
