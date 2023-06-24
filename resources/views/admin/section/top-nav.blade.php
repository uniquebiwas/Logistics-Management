        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            @hasanyrole('Super Admin|Admin|AWB admin|Super Account')
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                </ul>
            @endhasallroles

            <ul class="top-menu">

                @hasanyrole('Agent|Staff')
                    <li class="nav-item">
                        <a href="{{ url('agent/agent') }}"
                            class="nav-link {{ request()->is('agent/agent') ? 'active' : '' }}">Notice Board</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('shipment.create') }}"
                            class="nav-link {{ request()->is('agent/shipments/add-shipment') ? 'active' : '' }}">
                            Create AWB
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('shipment.index') }}"
                            class="nav-link {{ request()->is('agent/shipments') ? 'active' : '' }}">Courier Booking</a>
                    </li>
                    {{-- <li class="nav-item">
                    <a href="{{ route('agent-pricings') }}"
                        class="nav-link {{ request()->is('agent/agent-pricing') ? 'active' : '' }}">Zone Pricing</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('agentCountry') }}"
                        class="nav-link {{ request()->is('agent/country-guide') ? 'active' : '' }}">Zone Guide</a>
                </li> --}}
                    @canany(['agent-staff-list'])
                        <li class="nav-item">
                            <a href="{{ route('agent-staff.index') }}"
                                class="nav-link {{ request()->is('agent/agent-staff*') ? 'active' : '' }}">Staffs</a>
                        </li>
                    @endcanany
                    <li class="nav-item">
                        <a href="{{ route('credit.index') }}"
                            class="nav-link {{ request()->is('agent/credit*') ? 'active' : '' }}">Credit</a>
                    </li>

                @endhasallroles
                @hasanyrole('Super Admin|Admin|AWB admin|Super Account')
                    <li class="nav-item">
                        <a href="{{ route('dashboard.index') }}"
                            class="nav-link {{ request()->is('nd-admin') ? 'active' : '' }}">Notice Board</a>
                    </li>
                    @canany(['shipment-create'])

                        <li class="nav-item">
                            <a href="{{ route('shipmentpackage.create') }}"
                                class="nav-link {{ request()->is('nd-admin/shipmentpackage/create') ? 'active' : '' }}">Create
                                AWB</a>
                        </li>
                    @endcanany

                    @canany(['shipment-delete', 'shipment-approve', 'shipment-edit'])
                        <li class="nav-item">
                            <a href="{{ route('shipmentpackage.index') }}"
                                class="nav-link {{ request()->is('nd-admin/shipmentpackage') ? 'active' : '' }}">Courier
                                Booking</a>
                        </li>
                    @endcanany


                    @canany(['uploading-list', 'uploading-create', 'uploading-edit', 'uploading-delete', 'uploading-show'])
                        <li class="nav-item">
                            <a href="{{ route('export.index') }}"
                                class="nav-link {{ request()->is('nd-admin/export*') ? 'active' : '' }}">
                                Uploading
                            </a>
                        </li>
                    @endcanany
                    @canany(['international-list'])
                        <li class="nav-item">
                            <a href="{{ route('international-manifest.index') }}"
                                class="nav-link {{ request()->is('nd-admin/international-manifest*') && !request()->is('nd-admin/membershipHistory*')? 'active': '' }}">
                                International Manifest
                            </a>
                        </li>
                    @endcanany
                    @canany(['national-manifest-list'])
                        <li class="nav-item">
                            <a href="{{ route('national-manifest.index') }}"
                                class="nav-link {{ request()->is('nd-admin/national-manifest*') ? 'active' : '' }}">
                                Nepal Custom Manifest
                            </a>
                        </li>
                    @endcanany
                    @canany(['invoice-list'])
                        <li class="nav-item">
                            <a href="{{ route('invoice.index') }}"
                                class="nav-link {{ request()->is('nd-admin/invoice*') ? 'active' : '' }}">
                               Courier Invoice
                            </a>
                        </li>
                    @endcanany
                    @canany(['cargo-invoice-list'])
                    <li class="nav-item">
                        <a href="{{ route('cargo-invoice.index') }}"
                            class="nav-link {{ request()->is('nd-admin/cargo-invoice*') ? 'active' : '' }}">
                           Cargo Invoice
                        </a>
                    </li>
                @endcanany
                    @can(['api-management'])
                        <li class="nav-item">
                            <a href="{{ route('order-list') }}"
                                class="nav-link {{ request()->is('integrator-api/order-list*') ? 'active' : '' }}">
                                API integration
                            </a>
                        </li>
                    @endcan

                @endhasallroles


            </ul>


            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}" target="_banner" role="button">
                        <i class="fas fa-globe-asia"></i>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link pl-0" data-toggle="dropdown" href="#">
                        <span>{{ @\Auth::user()->agent_profile->company_name ?? @\Auth::user()->name['en'] }} <i
                                class="fas fa-angle-down fa-xs pl-1"></i></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                        <a href="{{ route('profiledetail') }}" class="dropdown-item pl-3 href="
                            class="">
                            <i class=" fas fa-user pr-1"></i> Profile</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('setting.index') }}" class="dropdown-item pl-3" type="button"> <i
                                class="fas fa-cog pr-1"></i>Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item pl-3" href="{{ route('user.logout') }}" title="Logout"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                class="fa fa-power-off pr-1"></i> Logout</a>
                        <form id="logout-form" action="{{ route('user.logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>

                </li>
            </ul>
            <div class="toggle-btns">
                <a class="nav-link" href="#" role="button"><i class="fas fa-bars"></i></a>
            </div>
        </nav>




        <script>
            $(".toggle-btns").click(function(e) {
                e.stopPropagation();
                $(".top-menu").toggleClass('active');
            });
        </script>
