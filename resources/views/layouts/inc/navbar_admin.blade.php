@php
    $currentUser = Auth::guard('web')->user();
@endphp

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm sticky-top">
    <div class="container-fluid">

        <span class="navbar-text ms-3 fw-semibold">
            @yield('page-title', 'Dashboard')
        </span>

        <ul class="navbar-nav ms-auto">
            {{-- NOTIFIKASI PESANAN  --}}
            <li class="nav-item me-3">
                <a href="{{ route('admin.ordermanagements.index') }}" id="orderNotificationLink"
                    class="nav-link position-relative notification-bell" title="Pesanan Baru">
                    <span class="fa fa-bell"></span>

                    <span id="orderNotificationBadge" class="position-absolute badge rounded-pill bg-danger d-none"
                        style="top: 2px; right: -6px;">
                    </span>
                </a>
            </li>

            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">

                    <img src="{{ $currentUser?->profile_photo
                        ? asset('storage/' . $currentUser->profile_photo)
                        : asset('img/admin.jpg') }}"
                        alt="Foto Profil" class="rounded-circle me-2 img-cover" width="32" height="32">

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
