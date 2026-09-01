@php
    $currentUser = Auth::guard('customer')->user();
@endphp

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #D6336C;">
    <div class="container-fluid">

        <a class="navbar-brand fw-bold text-white d-flex align-items-center" href="{{ route('customer.home') }}">
            <img src="{{ asset('img/logo.jpeg') }}" alt="Bloomora" width="32" height="32" class="rounded-circle me-2"
                style="object-fit: cover;">
            BLOOMORA
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">

            <ul class="navbar-nav mx-auto">

                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('customer.home') ? 'fw-bold border-bottom border-2 border-white' : '' }}"
                        href="{{ route('customer.home') }}">
                        HOME
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('customer.catalog.index') ? 'fw-bold border-bottom border-2 border-white' : '' }}"
                        href="{{ route('customer.catalog.index') }}">
                        PRODUCTS
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('customer.about') ? 'fw-bold border-bottom border-2 border-white' : '' }}"
                        href="{{ route('customer.about') }}">
                        ABOUT
                    </a>
                </li>

            </ul>

            <ul class="navbar-nav ms-auto flex-row align-items-center gap-1">

                <li class="nav-item">
                    <a class="nav-link position-relative text-white d-flex align-items-center" href=""
                        style="padding: 0.4rem 0.6rem;">
                        <span class="fa fa-shopping-cart" style="font-size: 1.3rem;"></span>

                        @php $cartCount = $currentUser?->carts()->count() ?? 0; @endphp

                        @if ($cartCount > 0)
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                style="font-size: 0.6rem;">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                </li>

                <!-- Profile -->
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle d-flex align-items-center text-white" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">

                        <img src="{{ $currentUser?->profile_photo
                            ? asset('storage/' . $currentUser->profile_photo)
                            : asset('images/default-avatar.png') }}"
                            alt="Foto Profil" class="rounded-circle me-2 border border-white" width="32"
                            height="32" style="object-fit: cover;">

                        {{ $currentUser?->name }}

                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">

                        <li>
                            <a class="dropdown-item" href="{{ route('customer.profile.edit') }}">
                                <span class="fa fa-user-circle"></span>
                                Ubah Profil
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="">
                                <span class="fa fa-history"></span>
                                Riwayat Pesanan
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form action="{{ route('customer.logout') }}" method="POST">
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
    </div>
</nav>
