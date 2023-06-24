@can(['cargo-management'])
    <li class="nav-header">CARGO CONTENT</li>
    <li
        class="nav-item has-treeview
{{ request()->is('nd-admin/gsp*') || request()->is('nd-admin/ncc*') ? 'menu-open' : '' }}">
        <a href="#"
            class="nav-link
    {{ request()->is('nd-admin/feature*') || request()->is('nd-admin/blog*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-friends"></i>
            <p>
                Cargo Content
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @canany(['ncc-list', 'ncc-create', 'ncc-edit', 'ncc-delete'])
                <li class="nav-item">
                    <a href="{{ route('ncc.index') }}" class="nav-link {{ request()->is('nd-admin/ncc*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-sliders-h"></i>
                        <p>Nepal Chamber of Commerce</p>
                    </a>
                </li>
            @endcanany
            @canany(['gsp-list', 'gsp-create', 'gsp-edit', 'gsp-delete'])
                <li class="nav-item">
                    <a href="{{ route('gsp.index') }}"
                        class="nav-link {{ request()->is('nd-admin/gsp*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-sliders-h"></i>
                        <p>Generalized System Of Preferences</p>
                    </a>
                </li>
            @endcanany

            @canany(['hbl-list', 'hbl-create', 'hbl-edit', 'hbl-delete'])
                <li class="nav-item">
                    <a href="{{ route('hbl.index') }}"
                        class="nav-link {{ request()->is('nd-admin/hbl*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-sliders-h"></i>
                        <p>House Bill Of Lading</p>
                    </a>
                </li>
            @endcanany

            @canany(['neffa-list', 'neffa-create', 'neffa-edit', 'neffa-delete'])
                <li class="nav-item">
                    <a href="{{ route('neffa.index') }}"
                        class="nav-link {{ request()->is('nd-admin/neffa*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-sliders-h"></i>
                        <p>Master Airway Bill</p>
                    </a>
                </li>
            @endcanany
            {{-- @canany(['cargo-invoice-list', 'cargo-invoice-create', 'cargo-invoice-edit', 'cargo-invoice-delete'])
            <li class="nav-item">
                <a href="{{ route('cargo-invoice.index') }}"
                    class="nav-link {{ request()->is('nd-admin/cargo-invoice*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-sliders-h"></i>
                    <p>Cargo Invoice</p>
                </a>
            </li>
        @endcanany --}}
        </ul>
    </li>
@endcan
