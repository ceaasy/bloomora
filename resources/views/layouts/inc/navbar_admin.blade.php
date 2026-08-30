@php
    $currentUser = Auth::guard('web')->user();
@endphp

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container-fluid">

        <span class="navbar-text ms-3 fw-semibold">
            @yield('page-title', 'Dashboard')
        </span>

        <ul class="navbar-nav ms-auto">

            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">

                    <img src="{{ $currentUser?->profile_photo
                        ? asset('storage/' . $currentUser->profile_photo)
                        : asset('images/default-avatar.png') }}"
                        alt="Foto Profil" class="rounded-circle me-2" width="32" height="32"
                        style="object-fit: cover;">

                    {{ $currentUser?->name }}

                </a>

                <ul class="dropdown-menu dropdown-menu-end">

                    <li>
                        <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                            <span class="fa fa-user-circle"></span>
                            Edit Profil
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf

                            <button type="submit" class="dropdown-item text-danger">
                                <span class="fa fa-sign-out"></span>
                                Logout
                            </button>
                        </form>
                    </li>

                </ul>

            </li>

        </ul>

    </div>
</nav>
