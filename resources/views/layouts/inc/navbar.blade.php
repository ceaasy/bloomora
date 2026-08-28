<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="{{ $isAdmin ? route('admin.dashboard') : route('customer.home') }}">
            Bloomora
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">

            @if (!$isAdmin)
                <ul class="navbar-nav mx-auto">
                    <a class="nav-link {{ request()->routeIs('customer.home') ? 'active fw-bold' : '' }}"
                        href="{{ route('customer.home') }}">
                        Home
                    </a>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products.*') ? 'active fw-bold' : '' }}"
                            href="">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active fw-bold' : '' }}"
                            href="">About</a>
                    </li>
                </ul>
            @else
                <span class="navbar-text ms-3 fw-semibold">
                    @yield('page-title', 'Dashboard')
                </span>
            @endif

            <ul class="navbar-nav ms-auto flex-row align-items-center gap-2">

                @if (!$isAdmin)
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="">
                            <i class="bi bi-cart3 fs-5"></i>
                            @php $cartCount = $currentUser->carts()->count() ?? 0; @endphp
                            @if ($cartCount > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    style="font-size: 0.6rem;">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                    </li>
                @endif

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ $currentUser->profile_photo ? asset('storage/' . $currentUser->profile_photo) : asset('images/default-avatar.png') }}"
                            alt="Foto Profil" class="rounded-circle me-2" width="32" height="32"
                            style="object-fit: cover;">
                        {{ $currentUser->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item"
                                href="{{ $isAdmin ? route('admin.profile.edit') : route('customer.profile.edit') }}">
                                <i class="bi bi-person-circle"></i> Edit Profil
                            </a>
                        </li>
                        @if (!$isAdmin)
                            <li>
                                <a class="dropdown-item" href="">
                                    <i class="bi bi-clock-history"></i> Riwayat Pesanan
                                </a>
                            </li>
                        @endif
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ $isAdmin ? route('admin.logout') : route('customer.logout') }}"
                                method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
