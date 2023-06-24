<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height=100%">
    <a href="" class="brand-link" style="background-color:#374f65">
        <img src="{{ @$sitesetting->favicon }}" alt="Nectar Digit" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ @$sitesetting->name ?? env('APP_NAME') }}</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-0 mb-3 d-flex">
            <div class="image">

            </div>

            <div class="info">
                <a href="{{ route('dashboard.index') }}" class="d-block">{{ @\Auth::user()->name['en'] }}<br>
                    <small>{{ request()->user()->roles->first()->name }}</small></a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent" data-widget="treeview"
                role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}"
                        class="nav-link {{ request()->is('nd-admin') || request()->is('agent/agent') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                           Dashboard
                        </p>
                    </a>
                </li>
                @hasanyrole('Agent|Staff')
                    @include('admin/section/agent-menu')
                @endhasallroles
                @hasanyrole('Super Admin|Admin|AWB admin|Super Account')
                    <li class="nav-header">ADMIN CONTENT</li>
                    <li class="nav-item">
                        <a href="{{ route('shipmentpackage.create') }}"
                            class="nav-link {{ request()->is('nd-admin/shipmentpackage/create') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-plus"></i>
                            <p>Create AWB</p>
                        </a>
                    </li>
                    <li
                        class="nav-item has-treeview {{ request()->is('nd-admin/deliveredShipmentPackage*') ||request()->is('nd-admin/incargoShipmentPackage*') ||request()->is('nd-admin/dispatchedShipmentPackage*') ||request()->is('nd-admin/scheduledShipmentPackage*') ||request()->is('nd-admin/receivedShipmentPackage*') ||request()->is('nd-admin/pendingShipmentPackage*') ||request()->is('nd-admin/shipmentpackage*') ||request()->is('nd-admin/approvedShipmentPackage*') ||request()->is('nd-admin/adminCancelledPackage*') ||request()->is('nd-admin/agentCancelledPackage*')? 'menu-open': '' }}">
                        <a href="#"
                            class="nav-link {{ request()->is('nd-admin/deliveredShipmentPackage*') ||request()->is('nd-admin/incargoShipmentPackage*') ||request()->is('nd-admin/dispatchedShipmentPackage*') ||request()->is('nd-admin/scheduledShipmentPackage*') ||request()->is('nd-admin/receivedShipmentPackage*') ||request()->is('nd-admin/pendingShipmentPackage*') ||request()->is('nd-admin/shipmentpackage*') ||request()->is('nd-admin/approvedShipmentPackage*') ||request()->is('nd-admin/adminCancelledPackage*') ||request()->is('nd-admin/agentCancelledPackage*')? 'active': '' }}">
                            <i class="nav-icon fas fa-boxes"></i>
                            <p>
                                Shipment Detail
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('shipmentpackage.index') }}"
                                    class="nav-link {{ request()->is('nd-admin/shipmentpackage*') && !request()->is('nd-admin/shipmentpackage/create')? 'active': '' }}">
                                    <i class="nav-icon fas fa-list"></i>
                                    <p>Courier Bookings</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('shipmentpackage.pending') }}"
                                    class="nav-link {{ request()->is('nd-admin/pendingShipmentPackage*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-pause"></i>
                                    <p>Pending</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('shipmentpackage.received') }}"
                                    class="nav-link {{ request()->is('nd-admin/receivedShipmentPackage*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-hand-holding"></i>
                                    <p>Received</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('shipmentpackage.manifested') }}"
                                    class="nav-link {{ request()->is('nd-admin/manifestedShipmentPackage*') ? 'active' : '' }}">
                                    <i class="fas fa-file-invoice nav-icon"></i>
                                    <p>Manifested</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('export.index') }}"
                                    class="nav-link {{ request()->is('nd-admin/export*') ? 'active' : '' }}">
                                    <i class="fas fa-paper-plane  nav-icon"></i>
                                    <p> Uploading</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('shipmentpackage.scheduled') }}"
                                    class="nav-link {{ request()->is('nd-admin/scheduledShipmentPackage*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-clock"></i>
                                    <p>Scheduled</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('shipmentpackage.dispatched') }}"
                                    class="nav-link {{ request()->is('nd-admin/dispatchedShipmentPackage*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-truck-loading"></i>
                                    <p>Dispatched</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('shipmentpackage.delivered') }}"
                                    class="nav-link {{ request()->is('nd-admin/deliveredShipmentPackage*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-hands"></i>
                                    <p>Delivered</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('shipmentpackage.cancelled.admin') }}"
                                    class="nav-link {{ request()->is('nd-admin/adminCancelledPackage*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-ban"></i>
                                    <p>Cancelled By Admin</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('shipmentpackage.cancelled.agent') }}"
                                    class="nav-link {{ request()->is('nd-admin/agentCancelledPackage*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-slash"></i>
                                    <p>Cancelled By Agent</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('shipmentpackage.handovertoagent') }}"
                                    class="nav-link {{ request()->is('nd-admin/handovertoagent*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-truck-loading"></i>
                                    <p>Hand Over To Agent</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('invoiced-shipment') }}"
                                    class="nav-link {{ request()->is('nd-admin/manifestedShipmentPackage*') ? 'active' : '' }}">
                                    <i class="fas fa-file-invoice nav-icon"></i>
                                    <p>Billed</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="nav-item has-treeview {{ request()->is('nd-admin/national-manifest*') || request()->is('nd-admin/international-manifest*')? 'menu-open': '' }}">
                        <a href="#"
                            class="nav-link {{ request()->is('nd-admin/international-manifest*') || request()->is('nd-admin/national-manifest*')? 'active': '' }}">
                            <i class="nav-icon fas fa-crown"></i>
                            <p>
                                Manifest
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            @canany(['international-list', 'international-create'])
                                <li class="nav-item">
                                    <a href="{{ route('international-manifest.index') }}"
                                        class="nav-link {{ request()->is('nd-admin/international-manifest*') && !request()->is('nd-admin/membershipHistory*')? 'active': '' }}">
                                        <i class="nav-icon fas fa-list"></i>
                                        <p>International</p>
                                    </a>
                                </li>
                            @endcanany
                            <li class="nav-item">
                                <a href="{{ route('national-manifest.index') }}"
                                    class="nav-link {{ request()->is('nd-admin/national-manifest*') ? 'active' : '' }}">
                                    <i class="fas fa-plane nav-icon"></i>

                                    <p>Nepal Custom Manifest </p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    @canany(['agents-list'])
                        <li class="nav-item">
                            <a href="{{ route('agents.index') }}"
                                class="nav-link {{ request()->is('nd-admin/agents*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-secret"></i>
                                <p>Agents</p>
                            </a>
                        </li>
                    @endcanany



                    @canany(['agent-credit-list'])
                        <li class="nav-item">
                            <a href="{{ route('agent-credit.index') }}"
                                class="nav-link {{ request()->is('nd-admin/agent-credit*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-credit-card    "></i>
                                <p>Agent Credit</p>
                            </a>
                        </li>
                    @endcanany

                    @canany(['zone-list', 'zone-create', 'zone-edit', 'zone-delete', 'rate-list', 'rate-view',
                        'rate-delete', 'zone-guide-list', 'zone-guide-create', 'zone-guide-import'])


                        <li
                            class="nav-item has-treeview {{ request()->is(['nd-admin/agent-pricing*','nd-admin/shipmentzone*','nd-admin/shipmentzone*','nd-admin/zonal*'])? 'menu-open': '' }}">
                            <a href="#"
                                class="nav-link {{ request()->is(['nd-admin/agent-pricing*','nd-admin/shipmentzone*','nd-admin/shipmentzone*','nd-admin/zonal*'])? 'active': '' }}">
                                <i class="fas fa-map-signs nav-icon   "></i>

                                <p>
                                    Zone and Rate
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @canany(['rate-list', 'rate-view', 'rate-delete'])
                                    <li class="nav-item">
                                        <a href="{{ route('admin.pricing.agent') }}"
                                            class="nav-link {{ request()->is('nd-admin/agent-pricing*') ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-users"></i>
                                            <p>Rate List</p>
                                        </a>
                                    </li>
                                @endcanany

                                @canany(['zone-list', 'zone-create', 'zone-edit', 'zone-delete'])
                                    <li class="nav-item">
                                        <a href="{{ route('shipmentzone.index') }}"
                                            class="nav-link {{ request()->is('nd-admin/shipmentzone*') ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-map-marked"></i>
                                            <p>Zones</p>
                                        </a>
                                    </li>
                                @endcanany

                                @canany(['zone-guide-list', 'zone-guide-create', 'zone-guide-import'])
                                    <li class="nav-item">
                                        <a href="{{ route('zonal.index') }}"
                                            class="nav-link {{ request()->is('nd-admin/zonal*') ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-map-pin"></i>
                                            <p>Zone Guide</p>
                                        </a>
                                    </li>
                                @endcanany


                            </ul>
                        </li>
                    @endcanany

                    @canany(['integrator-list', 'integrator-create', 'integrator-delete'])
                        <li class="nav-item">
                            <a href="{{ route('serviceagent.index') }}"
                                class="nav-link {{ request()->is('nd-admin/serviceagent*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-dolly-flatbed"></i>
                                <p>Integrator</p>
                            </a>
                        </li>
                    @endcanany

                    @canany(['shipmentpackagetype-list', 'shipmentpackagetype-create', 'shipmentpackagetype-show',
                        'shipmentpackagetype-edit'])
                        <li class="nav-item">
                            <a href="{{ route('shipmentpackagetype.index') }}"
                                class="nav-link {{ request()->is('nd-admin/shipmentpackagetype*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-box-open"></i>
                                <p>Shipment Type</p>
                            </a>
                        </li>
                    @endcanany
                    @canany(['location-list', 'location-create', 'location-show', 'location-update'])
                        <li class="nav-item">
                            <a href="{{ route('location.index', ['type' => 'LOCATION']) }}"
                                class="nav-link {{ request()->is('nd-admin/location/LOCATION*') ? 'active' : '' }}">

                                <i class="fas fa-location-arrow  nav-icon "></i>
                                <p>Location</p>
                            </a>
                        </li>
                    @endcanany

                    <li class="nav-item has-treeview {{ request()->is('nd-admin/location/*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('nd-admin/location/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-crown"></i>
                            <p>
                                Keyword
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ route('location.index', ['type' => 'RECEIVED']) }}"
                                    class="nav-link {{ request()->is('nd-admin/location/RECEIVED*') ? 'active' : '' }}">
                                    <i class="fas fa-receipt  nav-icon    "></i>
                                    <p>Received keyword</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('location.index', ['type' => 'DISPATCHED']) }}"
                                    class="nav-link {{ request()->is('nd-admin/location/DISPATCHED*') ? 'active' : '' }}">
                                    <i class="fas fa-receipt  nav-icon    "></i>
                                    <p>Dispatched keyword</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('location.index', ['type' => 'MANIFESTED']) }}"
                                    class="nav-link {{ request()->is('nd-admin/location/MANIFESTED*') ? 'active' : '' }}">
                                    <i class="fas fa-receipt  nav-icon    "></i>
                                    <p>manifested keyword</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @include('admin.section._cargoSidebar');
                    @include('admin.section._cmssidebar')
                    @include('admin.section._australianApiSidebar');

                    <li class="nav-header">APP SETTINGS</li>

                    @hasanyrole('Super Admin|Admin|AWB admin')

                        @canany(['user-list', 'user-create', 'user-edit', 'user-delete', 'role-list', 'role-create',
                            'role-edit', 'role-delete'])
                            <li
                                class="nav-item has-treeview {{ request()->is('nd-admin/users*') || request()->is('nd-admin/roles*') || request()->is('nd-admin/user-log')? 'menu-open': '' }}">
                                <a href="#"
                                    class="nav-link {{ request()->is('nd-admin/users*') || request()->is('nd-admin/roles*') || request()->is('nd-admin/user-log')? 'active': '' }}">
                                    <i class="nav-icon fas fa-users-cog"></i>
                                    <p>
                                        Users Management
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @can('user-create')
                                        <li class="nav-item">
                                            <a href="{{ route('users.create') }}"
                                                class="nav-link  {{ request()->is('nd-admin/users/create') ? 'active' : '' }}">
                                                <i class="fas fa-user-plus nav-icon"></i>
                                                <p>Add New User</p>
                                            </a>
                                        </li>
                                    @endcan
                                    @canany(['user-list', 'user-create', 'user-edit', 'user-delete'])
                                        <li class="nav-item">
                                            <a href="{{ route('users.index') }}"
                                                class="nav-link {{ request()->is('nd-admin/users') ? 'active' : '' }}">
                                                <i class="fas fa-users nav-icon"></i>
                                                <p>Users List</p>
                                            </a>
                                        </li>
                                    @endcanany
                                    @canany(['roles-list', 'roles-create', 'roles-edit', 'roles-delete'])
                                        <li class="nav-item">
                                            <a href="{{ route('roles.index') }}"
                                                class="nav-link {{ request()->is('nd-admin/roles*') ? 'active' : '' }}">
                                                <i class="fas fa-user-shield nav-icon"></i>
                                                <p>Roles & Permission</p>
                                            </a>
                                        </li>
                                    @endcanany

                                    @hasanyrole('Super Admin')
                                        <li class="nav-item">
                                            <a href="{{ route('user-log.index') }}"
                                                class="nav-link {{ request()->is('nd-admin/user-log') ? 'active' : '' }}">
                                                <i class="fas fa-history nav-icon"></i>
                                                <p>User Activity Log</p>
                                            </a>
                                        </li>
                                        <li></li>
                                    @endhasallroles
                                </ul>
                            </li>
                        @endcanany
                        @can('database-backup')
                            <li class="nav-item">
                                <a href="{{ route('database.backup.show') }}"
                                    class="nav-link {{ request()->is('nd-admin/database-backup*') ? 'active' : '' }}">
                                    <i class="fas fa-database nav-icon"></i>
                                    <p>Database backup</p>
                                </a>
                            </li>
                        @endcan
                        @canany(['menu-list', 'menu-create', 'menu-edit', 'menu-delete'])
                            <li class="nav-item has-treeview {{ request()->is('nd-admin/menu*') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ request()->is('nd-admin/menu*') ? 'active' : '' }}">
                                    <i class="nav-icon fab fa-mendeley"></i>
                                    <p>
                                        Menu Management
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">

                                    @can('menu-create')
                                        <li class="nav-item">
                                            <a href="{{ route('menu.create') }}"
                                                class="nav-link {{ request()->is('nd-admin/menu/create') ? 'active' : '' }}">
                                                <i class="fas fa-plus-circle nav-icon"></i>
                                                <p>Add New Menu</p>
                                            </a>
                                        </li>
                                    @endcan
                                    @canany(['menu-list', 'menu-create', 'menu-edit', 'menu-delete'])
                                        <li class="nav-item">
                                            <a href="{{ route('menu.index') }}"
                                                class="nav-link {{ request()->is('nd-admin/menu*') && !request()->is('nd-admin/menu/create') ? 'active' : '' }}">
                                                <i class="fas fa-bars nav-icon"></i>
                                                <p>Menu List</p>
                                            </a>
                                        </li>
                                    @endcanany
                                </ul>
                            </li>
                        @endcanany


                        @hasanyrole('Super Admin')

                        @endhasallroles
                    @endhasallroles

                    <li
                        class="nav-item has-treeview {{ request()->is('nd-admin/setting*') ||request()->is('nd-admin/cities') ||request()->is('nd-admin/vehicletype') ||request()->is('nd-admin/ridingcost')? 'menu-open': '' }}">
                        <a href="#"
                            class="nav-link {{ request()->is('nd-admin/setting*') ||request()->is('nd-admin/cities') ||request()->is('nd-admin/vehicletype') ||request()->is('nd-admin/ridingcost')? 'active': '' }}">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                General Setting
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            @hasanyrole('Super Admin|Admin|AWB admin')

                                <li class="nav-item">
                                    <a href="{{ route('setting.index') }}"
                                        class="nav-link {{ request()->is('nd-admin/setting') ? 'active' : '' }}">
                                        <i class="fas fa-tasks nav-icon"></i>
                                        <p>App Setting</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('websiteContentFormat') }}" class="nav-link">
                                        <i class="fas fa-cogs nav-icon"></i>
                                        <p>Website Content Format </p>
                                    </a>
                                </li>

                                {{-- <li class="nav-item">
                            <a href="{{ route('websiteContent') }}" class="nav-link">
                                <i class="fas fa-list nav-icon"></i>
                                <p>Website Content </p>
                            </a>
                        </li> --}}
                            @endhasallroles
                            <li class="nav-item">
                                <a href="{{ route('smsApi.index') }}"
                                    class="nav-link {{ request()->is('nd-admin/setting/sms') ? 'active' : '' }}">
                                    <i class="fas fa-sms nav-icon"></i>
                                    <p>SMS Setting</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endhasallroles
            </ul>
        </nav>
    </div>
</aside>
