<li class="nav-item">
    <a href="{{ route('agentProfile') }}" class="nav-link {{ request()->is('agent/my-profile*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>My Profile</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('agentDocuments') }}"
        class="nav-link {{ request()->is('agent/documents*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file"></i>
        <p>Documents</p>
    </a>
</li>

@if (request()->user()->documentVerifiedAt && request()->user()->emailVerifiedAt && request()->user()->phoneVerifiedAt )

<li class="nav-item has-treeview {{ request()->is('agent/agentmembership*') || request()->is('agent/membershipHistory') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ request()->is('agent/agentmembership*') || request()->is('agent/membershipHistory') ? 'active' : '' }}">
        <i class="nav-icon fa fa-crown"></i>
        <p>
            Membership Packages
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">

        <li class="nav-item">
            <a href="{{ route('agentmembership.index') }}"
                class="nav-link {{ request()->is('agent/agentmembership') ? 'active' : '' }}">
                <i class="fas fa-list nav-icon"></i>
                <p>Package List </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('agentmembership.history') }}"
                class="nav-link {{ request()->is('agent/membershipHistory') ? 'active' : '' }}">
                <i class="fas fa-history nav-icon"></i>
                <p>Membership History </p>
            </a>
        </li>


    </ul>
</li>
<li class="nav-item has-treeview {{ request()->is('agent/wallet*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ request()->is('agent/wallet*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-wallet"></i>
        <p>
            Wallet
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">

        <li class="nav-item">
            <a href="{{ route('wallet.create') }}"
                class="nav-link {{ request()->is('agent/wallet/create') ? 'active' : '' }}">
                <i class="fas fa-plus-circle nav-icon"></i>
                <p>Load Fund </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('wallet.index') }}"
                class="nav-link {{ request()->is('agent/wallet*') && !request()->is('agent/wallet/create') ? 'active' : '' }}">
                <i class="fas fa-coins nav-icon"></i>
                <p>Wallet </p>
            </a>
        </li>


    </ul>
</li>
<li class="nav-item has-treeview {{ request()->is('agent/shipments*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ request()->is('agent/shipments*') ? 'active' : '' }}">
        <i class="nav-icon fab fa-mendeley"></i>
        <p>
            Shipment Items
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">

        <li class="nav-item">
            <a href="{{ route('shipment.create') }}"
                class="nav-link {{ request()->is('agent/shipments/add-shipment') ? 'active' : '' }}">
                <i class="fas fa-plus-circle nav-icon"></i>
                <p>Add New Shipment</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('shipment.index') }}"
                class="nav-link {{ request()->is('agent/shipments') ? 'active' : '' }}">
                <i class="fas fa-list nav-icon"></i>
                <p>Shipment List</p>
            </a>
        </li>


    </ul>
</li>
<li class="nav-item">
    <a href="{{ route('customer.index') }}"
        class="nav-link {{ request()->is('agent/customer*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>Customer</p>
    </a>
</li>

@endif
