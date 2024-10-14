@php
    $settings = DB::table('settings')->first();
@endphp
        <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a class="brand-link" href="{{ route('admin.dashboard') }}">
        <span class="brand-text font-weight-light">
            <img src="" alt="" width="50px" height="50px"
                 srcset="{{ getThumbnail($settings->site_logo) }}">{{ $settings->site_name }}
        </span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" data-accordion="false"
                role="menu">
                <li class="nav-item">
                    <a class="nav-link @yield('dashboard')" href="{{ route('admin.dashboard') }}">
                        <i class="nav-icon fa fa-dashboard"></i>
                        {{ __('Dashboard') }}
                    </a>
                </li>

                {{-- @if (Auth::user()->can('admin.pickup-request.index'))
                    <li class="nav-item">
                        <a class="nav-link @yield('pickup-request')" href="{{ route('admin.pickup-request.index') }}">
                            <i class="nav-icon fa fa-fa fa-bars"></i>
                            {{ __('Pickup Request') }}
                        </a>
                    </li>
                @endif --}}

                @canany(['admin.pickup-request.index','admin.pickup-request.pending.deliveryman','admin.pickup-request.total.deliveryman'])
                <li class="nav-item @yield('order-management') ">
                    <a class="nav-link " href="javascript:;">
                        <i class="nav-icon fa fa-fa fa-bars"></i>
                        <p>
                            {{ __('Order Management') }}
                            <i class="fas fa-angle-left right"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview @yield('payments')">
                        <li class="nav-item">
                            <a class="nav-link @yield('pickup-request')" href="{{ route('admin.pickup-request.index') }}">
                                <i class="nav-icon far fa-circle"></i>
                                {{ __('Pickup Request') }}
                            </a>
                        </li>
                        @if(Auth::guard('admin')->user()->can('admin.pickup-request.pending.deliveryman')|| Auth::guard('admin')->user()->is_deliveryman == "1")

                            <li class="nav-item">
                                <a class="nav-link @yield('pending-for-delivery')"
                                   href="{{ route('admin.pickup-request.pending.deliveryman') }}">
                                    <i class="nav-icon far fa-circle"></i>
                                    {{ __('Waiting For Deliveryman') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @yield('total-for-delivery')"
                                   href="{{ route('admin.pickup-request.total.deliveryman') }}">
                                    <i class="nav-icon far fa-circle"></i>
                                    {{ __('Delivered Order') }}
                                </a>
                            </li>
                        @endif

                    </ul>
                </li>
                @endcan

                @canany(['admin.accounts.due'])
                <li class="nav-item @yield('accounts_menu') ">
                    <a class="nav-link " href="{{ route('admin.settings') }}">
                        <i class="nav-icon fas fa-desktop"></i>
                        <p>
                            {{ __('Cash On Delivery') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview @yield('accounts_menu')">
                        @if (Auth::user()->can('admin.accounts.due'))
                        <li class="nav-item">
                            <a class="nav-link @yield('due_account_menu')"
                                href="{{ route('admin.accounts.due') }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>{{ __('Accounts') }}</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endcanany
                @if (Auth::user()->can('admin.merchant.transaction.index') || Auth::user()->can('admin.merchant.recharge.request'))
                    <li class="nav-item @yield('payments') ">
                        <a class="nav-link " href="javascript:">
                            <i class="nav-icon fa fa-credit-card-alt"></i>
                            <p>
                                {{ __('Payments') }}
                                <i class="fas fa-angle-left right"></i>

                            </p>
                        </a>
                        <ul class="nav nav-treeview @yield('payments')">
                            @if (Auth::user()->can('admin.merchant.transaction.index'))
                                <li class="nav-item">
                                    <a class="nav-link @yield('transaction')"
                                       href="{{ route('admin.merchant.transaction.index') }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        {{ __('Transaction') }}
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->can('admin.merchant.recharge.request'))
                                <li class="nav-item">
                                    <a class="nav-link @yield('recharge-request')"
                                       href="{{ route('admin.merchant.recharge.request') }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        {{ __('Recharge Request') }}
                                        @can('admin.merchant.recharge.request.status')
                                            <span class="badge badge-warning">{{rechargePendingCount()}}</span>
                                        @endcan
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->is_merchant == 1)
                    <li class="nav-item @yield('merchant_api')">
                        <a class="nav-link " href="#">
                            <i class="nav-icon fab fa-kickstarter"></i>
                            <p>
                                {{ __('Api Keys') }}
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview @yield('merchant_api')">
                            <li class="nav-item">
                                <a class="nav-link  @yield('demo_key')"
                                   href="{{ route('admin.merchant.apikey.demo') }}">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>{{ __('Demo Key') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @yield('live_key')"
                                   href="{{ route('admin.merchant.apikey.live') }}">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>{{ __('Live Key') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif


                    @if (Auth::user()->can('admin.price-group.index') ||
                        Auth::user()->can('admin.price.index') ||
                        Auth::user()->can('admin.weights.index'))
                    <li class="nav-item @yield('price_menu') ">
                        <a class="nav-link " href="javascript:">
                            <i class="nav-icon fa-solid fa-dollar-sign"></i>
                            <p>
                                {{ __('Price') }}
                                <i class="fas fa-angle-left right"></i>

                            </p>
                        </a>
                        <ul class="nav nav-treeview @yield('price_menu')">
                            @if (Auth::user()->can('admin.price-group.index'))
                                <li class="nav-item">
                                    <a class="nav-link @yield('price_group')"
                                       href="{{ route('admin.price-group.index') }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>{{ __('Price Group') }}</p>
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->can('admin.price.index'))
                                <li class="nav-item">
                                    <a class="nav-link @yield('price')" href="{{ route('admin.price.index') }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>{{ __('Prices') }}</p>
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->can('admin.weights.index'))
                                <li class="nav-item">
                                    <a class="nav-link @yield('weight')" href="{{ route('admin.weights.index') }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>{{ __('Weight') }}</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->can('admin.merchant.index'))
                    <li class="nav-item @yield('merchant_menu') ">
                        <a class="nav-link " href="javascript:">
                            <i class="nav-icon fa-solid fa-user-alt"></i>
                            <p>
                                {{ __('Merchant') }}
                                <i class="fas fa-angle-left right"></i>

                            </p>
                        </a>
                        <ul class="nav nav-treeview @yield('merchant_menu')">
                            @if (Auth::user()->can('admin.merchant.index'))
                                <li class="nav-item">
                                    <a class="nav-link @yield('merchant_user')" href="{{ route('admin.merchant.index') }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>{{ __('Merchant User') }}</p>
                                    </a>
                                </li>
                            @endif
                            {{-- @if (Auth::user()->can('admin.merchant-request.index'))
                            <li class="nav-item">
                                <a class="nav-link @yield('merchant_request')" href="{{ route('admin.merchant-request.index') }}">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>{{ __('Merchant Request') }}</p>
                                </a>
                            </li>
                            @endif --}}
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->can('admin.deliveryman.index'))
                    <li class="nav-item @yield('deliveryman_menu')">
                        <a class="nav-link " href="javascript:void(0);">
                            <i class="nav-icon fa-solid fa-user-alt"></i>
                            <p>
                                {{ __('Delivery Man') }}
                                <i class="fas fa-angle-left right"></i>

                            </p>
                        </a>
                        <ul class="nav nav-treeview @yield('deliveryman_menu')">
                            @if (Auth::user()->can('admin.deliveryman.index'))
                                <li class="nav-item">
                                    <a class="nav-link @yield('deliveryman_list')"
                                       href="{{ route('admin.deliveryman.index') }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>{{ __('Delivery man list') }}</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->can('admin.contact.index'))
                    <li class="nav-item">
                        <a class="nav-link  @yield('contact')" href="{{ route('admin.contact.index') }}">
                            <i class="nav-icon fa fa-address-book"></i>
                            {{ __('Contact') }}
                        </a>
                    </li>
                @endif

                {{-- @if (Auth::user()->can('admin.faq.index'))
                    <li class="nav-item">
                        <a class="nav-link @yield('faq')" href="{{ route('admin.faq.index') }}">
                            <i class="nav-icon fa fa-question"></i>
                            {{ __('Faq') }}
                        </a>
                    </li>
                @endif --}}

                {{-- @if (Auth::user()->can('admin.customer.index'))
                    <li class="nav-item">
                        <a class="nav-link @yield('customer')" href="{{ route('admin.customer.index') }}">
                            <i class="nav-icon fa fa-user"></i>
                            {{ __('Customer') }}
                        </a>
                    </li>
                @endif --}}
                @if (Auth::user()->can('admin.country.index') ||
                        Auth::user()->can('admin.region.index') ||
                        Auth::user()->can('admin.cities.index'))
                    <li class="nav-item @yield('location_menu') ">
                        <a class="nav-link " href="javascript:">
                            <i class="nav-icon fas fa-location"></i>
                            <p>
                                {{ __('Location') }}
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview @yield('location_menu')">
                            @if (Auth::user()->can('admin.country.index'))
                                <li class="nav-item">
                                    <a class="nav-link @yield('country')" href="{{ route('admin.country.index') }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>{{ __('Country') }}</p>
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->can('admin.region.index'))
                                <li class="nav-item">
                                    <a class="nav-link @yield('region')" href="{{ route('admin.region.index') }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>{{ __('Region') }}</p>
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->can('admin.cities.index'))
                                <li class="nav-item">
                                    <a class="nav-link @yield('cities')" href="{{ route('admin.cities.index') }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>{{ __('City') }}</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->can('admin.user.index') ||
                        Auth::user()->can('admin.roles.index') ||
                        Auth::user()->can('admin.permissions.index'))
                    <li class="nav-item @yield('adnin_user_role') ">
                        <a class="nav-link " href="{{ route('admin.settings') }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                {{ __('Admin & Role') }}
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (Auth::user()->can('admin.user.index'))
                                <li class="nav-item">
                                    <a class="nav-link @yield('admin-user')" href="{{ route('admin.user.index') }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        {{ __('Admin') }}
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->can('admin.roles.index'))
                                <li class="nav-item">
                                    <a class="nav-link @yield('admin-roles')" href="{{ route('admin.roles.index') }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        {{ __('Roles') }}
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->can('admin.permissions.index'))
                                <li class="nav-item">
                                    <a class="nav-link @yield('admin-permissions')"
                                       href="{{ route('admin.permissions.index') }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        {{ __('Role permissions') }}
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->can('admin.settings.general') || Auth::user()->can('admin.seo.index'))
                    <li class="nav-item @yield('settings_menu') ">
                        <a class="nav-link " href="{{ route('admin.settings') }}">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                {{ __('Settings') }}
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview @yield('settings_menu')">
                            @if (Auth::user()->can('admin.settings.general'))
                                <li class="nav-item">
                                    <a class="nav-link @yield('general')"
                                       href="{{ route('admin.settings.general') }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>{{ __('General Settings') }}</p>
                                    </a>
                                </li>
                            @endif
                            {{-- @if (Auth::user()->can('admin.settings.language'))
                               <li class="nav-item">
                                   <a class="nav-link @yield('language')" href="{{ route('admin.settings.language') }}">
                                       <i class="nav-icon far fa-circle"></i>
                                       <p>{{ __('Language') }}</p>
                                   </a>
                               </li>
                               @endif --}}
                            @if (Auth::user()->can('admin.seo.index'))
                                <li class="nav-item">
                                    <a class="nav-link @yield('seo')" href="{{ route('admin.seo.index') }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>{{ __('SEO') }}</p>
                                    </a>
                                </li>
                            @endif
                            {{-- <li class="nav-item">
                                <a class="nav-link @yield('currency')"
                                    href="{{ route('admin.settings.currency.index') }}">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>{{ __('Currency') }}</p>
                                </a>
                            </li> --}}
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->can('admin.cms.ourservice.index') ||
                        Auth::user()->can('admin.cms.ecommerceService.index') ||
                        Auth::user()->can('admin.cms.get.pages'))
                    <li class="nav-item @yield('cms_menu') ">
                        <a class="nav-link " href="{{ route('admin.settings') }}">
                            <i class="nav-icon fas fa-desktop"></i>

                            <p>
                                {{ __('CMS') }}
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview @yield('cms_menu')">
                            @if (Auth::user()->can('admin.cms.ourservice.index'))
                                <li class="nav-item">
                                    <a class="nav-link @yield('our_service')"
                                       href="{{ route('admin.cms.ourservice.index') }}">
                                        <i class="nav-icon far fa-circle"></i>

                                        <p>{{ __('Our Service') }}</p>
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->can('admin.cms.ecommerceService.index'))
                                <li class="nav-item">
                                    <a class="nav-link @yield('ecommerce')"
                                       href="{{ route('admin.cms.ecommerceService.index') }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>{{ __('Ecommerce Service') }}</p>
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->can('admin.cms.get.pages'))
                                <li class="nav-item">
                                    <a class="nav-link @yield('pages')" href="{{ route('admin.cms.get.pages') }}">
                                        <i class="nav-icon far fa-circle"></i>

                                        <p>{{ __('Pages') }}</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif



            </ul>
        </nav>
    </div>
</aside>
