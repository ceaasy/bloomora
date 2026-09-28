<div class="d-flex flex-column sidebar-admin">

    <div class="p-3 d-flex align-items-center shadow-sm">
        <img src="{{ asset('img/logo.jpeg') }}" alt="Bloomora" width="32" height="32"
            class="rounded-circle me-2 img-cover">
        <span class="fw-bold sidebar-brand-text">BLOOMORA</span>

    </div>

    <ul class="nav flex-column p-2 gap-1">

        <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 px-3 py-2 sidebar-link {{ request()->routeIs('admin.dashboard.*') ? 'is-active' : '' }}"
                href="{{ route('admin.dashboard.index') }}">
                <span class="fa fa-home"></span>
                <span class="text-uppercase sidebar-link-label">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 px-3 py-2 sidebar-link {{ request()->routeIs('admin.admin.*') ? 'is-active' : '' }}"
                href="{{ route('admin.admin.index') }}">
                <span class="fa fa-user"></span>
                <span class="text-uppercase sidebar-link-label">Admin</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 px-3 py-2 sidebar-link {{ request()->routeIs('admin.customers.*') ? 'is-active' : '' }}"
                href="{{ route('admin.customers.index') }}">
                <span class="fa fa-users"></span>
                <span class="text-uppercase sidebar-link-label">Customer</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 px-3 py-2 sidebar-link {{ request()->routeIs('admin.products.*') ? 'is-active' : '' }}"
                href="{{ route('admin.products.index') }}">
                <span class="fa fa-archive"></span>
                <span class="text-uppercase sidebar-link-label">Product</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 px-3 py-2 sidebar-link {{ request()->routeIs('admin.ordermanagements.*', 'admin.paymentmanagements.*', 'admin.shipmentmanagements.*') ? 'is-active' : '' }}"
                href="{{ route('admin.ordermanagements.index') }}">
                <span class="fa fa-shopping-bag"></span>
                <span class="text-uppercase sidebar-link-label">Order Management</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 px-3 py-2 sidebar-link {{ request()->routeIs('admin.reviewmanagements.*') ? 'is-active' : '' }}"
                href="{{ route('admin.reviewmanagements.index') }}">
                <span class="fa fa-star text-warning"></span>
                <span class="text-uppercase sidebar-link-label">Review</span>
            </a>
        </li>

    </ul>
</div>
