<div class="app-menu navbar-menu">
    <div class="navbar-brand-box">
        <a href="/" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('fa-bt/logo/FABT-Logo.png') }}" alt="" height="17">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('fa-bt/logo/FABT-Logo.png') }}" alt="" height="60">
            </span>
        </a>
        <a href="/" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('fa-bt/logo/FABT-Logo.png') }}" alt="" height="17">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('fa-bt/logo/FABT-Logo.png') }}" alt="" height="60">
            </span>
        </a>
        <button type="button" class="p-0 btn btn-sm fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                @role('admin')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/">
                        <i class="mdi mdi-speedometer"></i>
                        <span data-key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                @endrole
                @role('admin')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="mdi mdi-cube-outline"></i>
                        <span data-key="t-design">Design</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('slider.index') }}" class="nav-link" data-key="t-slider"> Slider </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-slider"> Two Column Banner </a>
                            </li> --}}
                        </ul>
                    </div>
                </li>
                @endrole
                @role('admin')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="mdi mdi-view-grid-plus-outline"></i>
                        <span data-key="t-catalogs">Catalogs</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('brand.index') }}" class="nav-link" data-key="t-brand"> Brands </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('categories.index') }}" class="nav-link" data-key="t-categories"> Main Categories </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('product.index') }}" class="nav-link" data-key="t-product"> Products </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endrole
                @role('editor')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="mdi mdi-view-grid-plus-outline"></i>
                        <span data-key="t-catalogs">Catalogs</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('product.index') }}" class="nav-link" data-key="t-product"> Products </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endrole
                @role('admin')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('promotions.index')}}">
                        <i class="mdi mdi-bullhorn-variant"></i>
                        <span data-key="t-promotions">Promotions</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('orders') }}">
                        <i class="mdi mdi-bank-plus"></i>
                        <span data-key="t-catalogs">Orders</span>
                    </a>
                </li>
                @endrole

                @role('admin')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarinventory" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="mdi mdi-store"></i>
                        <span data-key="t-catalogs">Inventory</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarinventory">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('availability.index') }}" class="nav-link" data-key="t-brand"> Stock Status </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('stock.opening') }}" class="nav-link" data-key="t-brand"> Opening Stock </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="{{ route('inventory.stock_adjustment') }}" class="nav-link" data-key="t-brand"> Stock Adjustment </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('inventory.purchaseinventory') }}" class="nav-link" data-key="t-brand"> Purchase </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('inventory.salesinventory') }}" class="nav-link" data-key="t-brand"> Sales </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('inventory.warehouse') }}" class="nav-link" data-key="t-brand"> Inventory </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('availability.index') }}" class="nav-link" data-key="t-brand"> Stock Status </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('warehouse.index') }}" class="nav-link" data-key="t-brand"> Warehouse </a>
                            </li> --}}
                        </ul>
                    </div>
                </li>
                @endrole

                @role('admin')
                {{-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarservices" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="mdi mdi-wrench-clock"></i>
                        <span data-key="t-catalogs">Services</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarservices">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('services.index') }}" class="nav-link" data-key="t-brand"> Services </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
                @endrole
                        {{-- <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarwebsite" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarApps">
                                <i class="mdi mdi-earth"></i> <span data-key="t-catalogs">Website</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarwebsite">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="" class="nav-link" data-key="t-categories"> Our Works </a>
                                    </li>
                                </ul>
                            </div>
                        </li> --}}
                @role('admin')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarusers" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="mdi mdi-shield-account-outline"></i>
                        <span data-key="t-catalogs">System User</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarusers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link" data-key="t-brand"> User </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('permissions.index') }}" class="nav-link" data-key="t-categories"> Permissions</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}" class="nav-link" data-key="t-product"> Roles </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endrole
                        {{-- <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ route('customer.index') }}">
                                <i class="mdi mdi-face-man-profile"></i> <span data-key="t-customer">Customer</span>
                            </a>
                        </li> --}}
                @role('admin')
                {{-- <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('setting.index')}}">
                        <i class="mdi mdi-cog-outline"></i>
                        <span data-key="t-dashboards">Setting</span>
                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarsetting" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="mdi mdi-cog-outline"></i>
                        <span data-key="t-catalogs">Setting</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarsetting">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('currency.index') }}" class="nav-link" data-key="t-brand"> Currency </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" data-key="t-company">Company</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" data-key="t-shipping">Shipping</a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" data-key="t-payment">Payments</a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
                @endrole
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-exit-to-app"></i><span data-key="t-logout">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <div class="sidebar-background"></div>
</div>
<div class="vertical-overlay"></div>
