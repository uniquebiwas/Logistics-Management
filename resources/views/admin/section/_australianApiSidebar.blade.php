@can(['api-management'])
    <li class="nav-header">API MANAGEMENT</li>
    <li class="nav-item has-treeview
{{ request()->is('integrator-api/*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link
    {{ request()->is('integrator-api/*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-friends"></i>
            <p>
                API Management
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('order-list') }}"
                    class="nav-link {{ request()->is('integrator-api/order-list*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-sliders-h"></i>
                    <p>All Orders</p>
                </a>
            </li>
        </ul>
    </li>
@endcan
