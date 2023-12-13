<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            @if (websiteSetupValue('logo'))
                <img src="{{ asset('admin_css/admin/website_setup/' . websiteSetupValue('logo')) }}" class="img-fluid"
                    style="height: 40px">
            @else
                <h2 class="text-white">{{ config('app.name') }}</h2>
            @endif
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item mt-0 {{ activeRoute(['admin.dashboard']) ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="link-icon fa-lg bi bi-speedometer"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            @canany(['user-list', 'web_setup', 'payment-history_list', 'staff-list', 'role-list'])
                <li class="nav-item nav-category">Web Apps</li><hr>
            @endcanany


            <li class="nav-item {{ activeRoute(['salon.index', 'salon.create', 'salon.edit', 'salon.show', 'salon-gallery.edit', 'availability-hour.edit']) ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#salonManagement" role="button"
                    aria-expanded="false" aria-controls="salonManagement">
                    <i class="link-icon fa-lg bi bi-scissors"></i>
                    <span class="link-title">Salons Management</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ activeRoute(['salon.index', 'salon.create', 'salon.edit', 'salon.show', 'salon-gallery.edit', 'availability-hour.edit', 'service-booking.index']) ? 'show' : '' }}"
                    id="salonManagement">
                    <ul class="nav sub-menu">

                        <li class="nav-item ">
                            <a href="{{ route('salon.index') }}"
                                class="nav-link {{ activeRoute(['salon.index', 'salon.create', 'salon.edit', 'salon.show', 'salon-gallery.edit', 'availability-hour.edit', 'service-booking.index']) ? 'active' : '' }}">Salons List</a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{ route('service-booking.index') }}"
                                class="nav-link {{ activeRoute(['service-booking.index']) ? 'active' : '' }}">Booking List</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="nav-item {{ activeRoute(['service-category.index', 'service-category.edit', 'service-subcategory.index', 'service-subcategory.edit', 'services.index', 'services.create', 'services.edit']) ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#serviceManagement" role="button"
                    aria-expanded="false" aria-controls="serviceManagement">
                    <i class="link-icon fa-lg bi bi-tags"></i>
                    <span class="link-title">Service Management</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ activeRoute(['service-category.index', 'service-category.edit', 'service-subcategory.index', 'service-subcategory.edit', 'services.index', 'services.create', 'services.edit']) ? 'show' : '' }}"
                    id="serviceManagement">
                    <ul class="nav sub-menu">

                        <li class="nav-item ">
                            <a href="{{ route('service-category.index') }}"
                                class="nav-link {{ activeRoute(['service-category.index', 'service-category.edit']) ? 'active' : '' }}">Category List</a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{route('service-subcategory.index')}}"
                                class="nav-link {{ activeRoute(['service-subcategory.index', 'service-subcategory.edit']) ? 'active' : '' }}">Sub Category List</a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{route('services.index')}}"
                                class="nav-link {{ activeRoute(['services.index', 'services.create', 'services.edit']) ? 'active' : '' }}">Service List</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="nav-item {{ activeRoute(['product-category.index', 'product-category.edit', 'product-subcategory.index', 'product-subcategory.edit', 'products.index', 'products.create', 'products.edit']) ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#productManagement" role="button"
                    aria-expanded="false" aria-controls="productManagement">
                    <i class="link-icon fa-lg bi bi-clipboard2-data"></i>
                    <span class="link-title">Product Management</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ activeRoute(['product-category.index', 'product-category.edit', 'product-subcategory.index', 'product-subcategory.edit', 'products.index', 'products.create', 'products.edit']) ? 'show' : '' }}"
                    id="productManagement">
                    <ul class="nav sub-menu">

                        <li class="nav-item ">
                            <a href="{{ route('product-category.index') }}"
                                class="nav-link {{ activeRoute(['product-category.index', 'product-category.edit']) ? 'active' : '' }}">Category List</a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{route('product-subcategory.index')}}"
                                class="nav-link {{ activeRoute(['product-subcategory.index', 'product-subcategory.edit']) ? 'active' : '' }}">Sub Category List</a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{route('products.index')}}"
                                class="nav-link {{ activeRoute(['products.index', 'products.create', 'products.edit']) ? 'active' : '' }}">Product List</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="nav-item {{ activeRoute(['service-coupon.index', 'service-coupon.create', 'service-coupon.edit', 'product-coupon.index', 'product-coupon.create', 'product-coupon.edit']) ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#couponManagement" role="button"
                    aria-expanded="false" aria-controls="couponManagement">
                    <i class="link-icon fa-lg bi bi-receipt-cutoff"></i>
                    <span class="link-title">Coupon Management</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ activeRoute(['service-coupon.index', 'service-coupon.create', 'service-coupon.edit', 'product-coupon.index', 'product-coupon.create', 'product-coupon.edit']) ? 'show' : '' }}"
                    id="couponManagement">
                    <ul class="nav sub-menu">

                        <li class="nav-item ">
                            <a href="{{ route('service-coupon.index') }}"
                                class="nav-link {{ activeRoute(['service-coupon.index', 'service-coupon.create', 'service-coupon.edit']) ? 'active' : '' }}">Service Coupon List</a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{ route('product-coupon.index') }}"
                                class="nav-link {{ activeRoute(['product-coupon.index', 'product-coupon.create', 'product-coupon.edit']) ? 'active' : '' }}">Product Coupon List</a>
                        </li>

                    </ul>
                </div>
            </li>


            <li class="nav-item {{ activeRoute(['user.index', 'user.edit', 'user-address.index']) ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#userManagement" role="button"
                    aria-expanded="false" aria-controls="userManagement">
                    <i class="link-icon fa fa-lg bi bi-person"></i>
                    <span class="link-title">User Management</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ activeRoute(['user.index', 'user.edit', 'user-address.index']) ? 'show' : '' }}"
                    id="userManagement">
                    <ul class="nav sub-menu">

                        <li class="nav-item ">
                            <a href="{{ route('user.index') }}"
                                class="nav-link {{ activeRoute(['user.index', 'user.edit', 'user-address.index']) ? 'active' : '' }}">User
                                List</a>
                        </li>

                    </ul>
                </div>
            </li>


            @canany(['payment-history_list'])
                <li
                    class="nav-item {{ activeRoute(['transaction.payment']) ? 'active' : '' }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#transaction" role="button" aria-expanded="false"
                        aria-controls="transaction">
                        <i class="link-icon fa-lg bi bi-wallet2"></i>
                        <span class="link-title">Transaction</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ activeRoute(['transaction.payment']) ? 'show' : '' }}"
                        id="transaction">
                        <ul class="nav sub-menu">
                            @can('payment-history_list')
                                <li class="nav-item ">
                                    <a href="{{ route('transaction.payment') }}"
                                        class="nav-link {{ activeRoute(['transaction.payment']) ? 'active' : '' }}">Payment</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcanany
            @canany(['staff-list', 'role-list'])
                <li
                    class="nav-item {{ activeRoute(['staffs.index', 'staffs.create', 'staffs.edit']) ? 'active' : '' }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#saff_management" role="button"
                        aria-expanded="false" aria-controls="saff_management">
                        <i class="link-icon fa-lg bi bi-people"></i>
                        <span class="link-title">Staff Management</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ activeRoute(['staffs.index', 'staffs.create', 'staffs.edit', 'roles.index', 'roles.create', 'roles.edit']) ? 'show' : '' }}"
                        id="saff_management">
                        <ul class="nav sub-menu">
                            @can('staff-list')
                                <li class="nav-item ">
                                    <a href="{{ route('staffs.index') }}"
                                        class="nav-link {{ activeRoute(['staffs.index', 'staffs.create', 'staffs.edit']) ? 'active' : '' }}">All
                                        Staffs</a>
                                </li>
                            @endcan
                            @can('role-list')
                                <li class="nav-item ">
                                    <a href="{{ route('roles.index') }}"
                                        class="nav-link {{ activeRoute(['roles.index', 'roles.create', 'roles.edit']) ? 'active' : '' }}">All
                                        Roles</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcanany
            @canany(['web_setup'])
                <li class="nav-item {{ activeRoute(['web_setup.index']) ? 'active' : '' }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#webisiteSetting" role="button"
                        aria-expanded="false" aria-controls="webisiteSetting">
                        <i class="link-icon fa-lg bi bi-gear"></i>
                        <span class="link-title">Web Setting</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ activeRoute(['web_setup.index']) ? 'show' : '' }}"
                        id="webisiteSetting">
                        <ul class="nav sub-menu">
                            @can('web_setup')
                                <li class="nav-item ">
                                    <a href="{{ route('web_setup.index') }}"
                                        class="nav-link {{ activeRoute(['web_setup.index']) ? 'active' : '' }}">Web Setup</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcanany
            @canany(['slider-list', 'banner-list'])
                <li class="nav-item nav-category">mobile apps</li><hr>
                <li
                    class="nav-item {{ activeRoute(['app_sliders.index', 'app_sliders.edit']) ? 'active' : '' }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#slider_banner_setting" role="button"
                        aria-expanded="false" aria-controls="slider_banner_setting">
                        <i class="link-icon fa-lg bi bi-gear-wide-connected"></i>
                        <span class="link-title">App Setting</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ activeRoute(['app_sliders.index', 'app_sliders.edit']) ? 'show' : '' }}"
                        id="slider_banner_setting">
                        <ul class="nav sub-menu">
                            @can('slider-list')
                                <li class="nav-item ">
                                    <a href="{{ route('app_sliders.index') }}"
                                        class="nav-link {{ activeRoute(['app_sliders.index', 'app_sliders.edit']) ? 'active' : '' }}">Sliders</a>
                                </li>
                            @endcan
                            {{-- @can('banner-list')
                                <li class="nav-item ">
                                    <a href="{{ route('app_banners.index') }}"
                                        class="nav-link {{ activeRoute(['app_banners.index', 'app_banners.edit']) ? 'active' : '' }}">Banner</a>
                                </li>
                            @endcan --}}
                        </ul>
                    </div>
                </li>
            @endcanany
        </ul>
    </div>
</nav>
