<div class="d-flex flex-column" style="width: 220px; min-height: 100vh; background-color: #FBE3EC;">

    <div class="p-3 d-flex align-items-center shadow-sm">
        <img src="{{ asset('img/logo.jpeg') }}" alt="Bloomora" width="32" height="32" class="rounded-circle me-2"
            style="object-fit: cover;">
        <span class="fw-bold" style="color: #4A3F3F;">BLOOMORA</span>

    </div>

    <ul class="nav flex-column p-2 gap-1">

        <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 px-3 py-2"
                style="color: #4A3F3F; border-radius: 8px; {{ request()->routeIs('admin.dashboard') ? 'background-color: #FFFFFF; font-weight: 600;' : '' }}"
                href="{{ route('admin.dashboard') }}">
                <span class="fa fa-home"></span>
                <span class="text-uppercase" style="font-sze: 13px;">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 px-3 py-2"
                style="color: #4A3F3F; border-radius: 8px; {{ request()->routeIs('admin.admin.*') ? 'background-color: #FFFFFF; font-weight: 600;' : '' }}"
                href="{{ route('admin.admin.index') }}">
                <span class="fa fa-user"></span>
                <span class="text-uppercase" style="font-size: 13px;">Admin</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 px-3 py-2"
                style="color: #4A3F3F; border-radius: 8px; {{ request()->routeIs('admin.customers.*') ? 'background-color: #FFFFFF; font-weight: 600;' : '' }}"
                href="{{ route('admin.customers.index') }}">
                <span class="fa fa-users"></span>
                <span class="text-uppercase" style="font-size: 13px;">Customer</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 px-3 py-2"
                style="color: #4A3F3F; border-radius: 8px; {{ request()->routeIs('admin.products.*') ? 'background-color: #FFFFFF; font-weight: 600;' : '' }}"
                href="#">
                <span class="fa fa-archive"></span>
                <span class="text-uppercase" style="font-size: 13px;">Product</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 px-3 py-2"
                style="color: #4A3F3F; border-radius: 8px; {{ request()->routeIs('admin.orders.*') ? 'background-color: #FFFFFF; font-weight: 600;' : '' }}"
                href="#">
                <span class="fa fa-shopping-bag"></span>
                <span class="text-uppercase" style="font-size: 13px;">Order Management</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 px-3 py-2"
                style="color: #4A3F3F; border-radius: 8px; {{ request()->routeIs('admin.reviews.*') ? 'background-color: #FFFFFF; font-weight: 600;' : '' }}"
                href="#">
                <span class="fa fa-star text-warning"></span>
                <span class="text-uppercase" style="font-size: 13px;">Review</span>
            </a>
        </li>

    </ul>
</div>
