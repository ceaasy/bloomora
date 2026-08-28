<div class="sidebar bg-primary text-white" style="width: 250px; min-height: 100vh;">
    <div class="p-3 border-bottom border-secondary">
        <h5 class="mb-0"> Bloomora</h5>
    </div>
    <ul class="nav flex-column p-2">
        <li class="nav-item">
            <a class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active bg-primary rounded' : '' }}"
                href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white {{ request()->routeIs('admin.admins.*') ? 'active bg-primary rounded' : '' }}"
                href="">
                <i class="bi bi-person-badge"></i> Admin
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white {{ request()->routeIs('admin.customers.*') ? 'active bg-primary rounded' : '' }}"
                href="">
                <i class="bi bi-people"></i> Customer
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white {{ request()->routeIs('admin.products.*') ? 'active bg-primary rounded' : '' }}"
                href="">
                <i class="bi bi-box-seam"></i> Product
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white {{ request()->routeIs('admin.orders.*') ? 'active bg-primary rounded' : '' }}"
                href="">
                <i class="bi bi-receipt"></i> Order Management
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white {{ request()->routeIs('admin.reviews.*') ? 'active bg-primary rounded' : '' }}"
                href="">
                <i class="bi bi-star"></i> Review
            </a>
        </li>
    </ul>
</div>
