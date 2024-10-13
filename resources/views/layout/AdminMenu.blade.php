@php
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Item;
use App\Models\ItemType;
use App\Models\ItemTax;

use App\Models\Admin;
use App\Models\User;

$orderCount = Order::count();
$couponsCount = Coupon::count();
$itemCount = Item::count();
$itemtypeCount = ItemType::count();
$itemtaxCount = ItemTax::count();
$adminCount = Admin::count();
$userCount = User::count();
@endphp

<div class="leftside-menu">

    <!-- Logo Light -->
    <a href="{{route('admin.dashboard.index')}}" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{asset('assets/images/tree logo.png')}}" alt="logo" style="vertical-align: middle;">
            <h4 style="color: white; display: inline-block; margin-left: 5px;">Elkhawas
                Trade</h4>
        </span>

        <span class="logo-sm">
            <img src="{{asset('assets/images/tree logo.png')}}" alt="small logo">
        </span>
    </a>

    <!-- Logo Dark -->
    <a href="/" class="logo logo-dark">
        <span class="logo-lg">
            <img src="{{asset('assets/images/tree logo.png')}}" alt="logo" style="vertical-align: middle;">
            <h4 style="color: black; display: inline-block; margin-left: 5px;">Elkhawas
                Trade</h4>
        </span>

        <span class="logo-sm">
            <img src="{{asset('assets/images/tree logo.png')}}" alt="small logo">
        </span>
    </a>

    <!-- Sidebar -->
    <div data-simplebar>
        <ul class="side-nav">
            @can('dashboard')
            <li class="side-nav-title">{{__('translation.Main')}}</li>



            <li class="side-nav-item">
                <a href="{{route('admin.dashboard.index')}}" class="side-nav-link">
                    <i class="ri-dashboard-2-line"></i>
                    <span> {{__('translation.Dashboard')}} </span>
                    <!-- <span class="badge bg-success float-end">9+</span> -->
                </a>
            </li>
            @endcan




<li class="side-nav-item">
                <a href="{{route('licenses.index')}}" class="side-nav-link">
                    <i class="ri-dashboard-2-line"></i>
                    <span> Licenses </span>
                    <!-- <span class="badge bg-success float-end">9+</span> -->
                </a>
            </li>


<li class="side-nav-item">
                <a href="{{route('media.index')}}" class="side-nav-link">
                    <i class="ri-dashboard-2-line"></i>
                    <span> Media </span>
                    <!-- <span class="badge bg-success float-end">9+</span> -->
                </a>
            </li>
           






            @can('item-list')
            <li class="side-nav-title">{{__('translation.Items')}}</li>


            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#products" aria-expanded="false" aria-controls="products" class="side-nav-link">
                    <i class="ri-shopping-bag-line"></i>
                    <span>{{__('translation.Item')}}</span>
                    <span class="menu-arrow"></span>

                </a>
                <div class="collapse" id="products">
                    <ul class="side-nav-second-level">



                        <li class="side-nav-item">
                            <a class="side-nav-link" href="{{route('admin.items.index')}}">{{__('translation.Items list')}}
                                <span class="order-count-badge">{{ $itemCount }}</span>

                            </a>
                        </li>


                        @can('item-type-list')
                        <li class="side-nav-item">
                            <a class="side-nav-link" href="{{route('admin.itemtypes.index')}}">{{__('translation.Items typesList')}}</a>
                        </li>
                        @endcan

                        @can('item-tax-list')
                        <li class="side-nav-item">
                            <a class="side-nav-link" href="{{route('admin.itemtaxes.index')}}">{{__('translation.Items taxesList')}}</a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </li>

            @endcan

            @can('order-list')
            <li class="side-nav-title">{{__('translation.Orders')}}</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#order" aria-expanded="false" aria-controls="order" class="side-nav-link">
                    <i class="ri-shopping-basket-line"></i>
                    <span> {{__('translation.Orders')}} </span>
                    <span class="menu-arrow"></span>

                </a>
                <div class="collapse" id="order">
                    <ul class="side-nav-second-level">


                        <li class="side-nav-item">
                            <a class="side-nav-link" href="{{route('admin.orders.index')}}">{{__('translation.Orders List')}}
                                <span class="order-count-badge">{{ $orderCount }}</span>
                            </a>
                        </li>
                        @endcan

                        @can('coupon-list')

                        <li class="side-nav-item">
                            <a class="side-nav-link" href="{{route('admin.coupons.index')}}">{{__('translation.Coupons')}}</a>
                        </li>
                        @endcan



                    </ul>
                </div>
            </li>


            @can('admin-titl')



            <li class="side-nav-title">{{__('translation.Authentications')}}</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#admins" aria-expanded="false" aria-controls="admins" class="side-nav-link">
                    <i class="ri-admin-line"></i>
                    <span> {{__('translation.Admin Jobs')}} </span>
                    <span class="menu-arrow"></span>

                </a>
                <div class="collapse" id="admins">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item">
                            @can('admin-list')
                            <a class="side-nav-link" href="{{route('admins.index')}}">{{__('translation.Admin List')}}</a>
                        </li>
                        @endcan

                        @can('role-list')
                        <li class="side-nav-item">
                            <a class="side-nav-link" href="{{route('roles.index')}}">{{__('translation.Roles&Premisstions')}}</a>
                        </li>
                        @endcan

                    </ul>
                </div>
            </li>

            @endcan


            @can('user-list')

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#user" aria-expanded="false" aria-controls="user" class="side-nav-link">
                    <i class="ri-user-line"></i>
                    <span> {{__('translation.Users')}} </span>
                    <span class="menu-arrow"></span>

                </a>
                <div class="collapse" id="user">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item">
                            <a class="side-nav-link" href="{{route('admin.users.index')}}">{{__('translation.User List')}}</a>
                        </li>

                    </ul>
                </div>
            </li>

            @endcan


            @can('settings')


            <li class="side-nav-title">{{__('translation.Settings')}}</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#setting" aria-expanded="false" aria-controls="setting" class="side-nav-link">
                    <i class="ri-settings-3-line"></i>
                    <span> {{__('translation.Settings')}} </span>
                    <span class="menu-arrow"></span>

                </a>
                <div class="collapse" id="setting">
                    <ul class="side-nav-second-level">
                        <li class="side-nav-item">
                            <a class="side-nav-link" href="{{route('ContactUs.index')}}">{{__('translation.Contact Us')}}</a>
                        </li>



                    </ul>
                </div>
            </li>

            @endcan


            @can('chatting')



            <li class="side-nav-title">{{__('translation.Chatting')}}</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#chatt" aria-expanded="false" aria-controls="chatt" class="side-nav-link">
                    <i class="ri-chat-3-line"></i>

                    <span> {{__('translation.Chatting')}}</span>
                    <span class="menu-arrow"></span>

                </a>
                <div class="collapse" id="chatt">
                    <ul class="side-nav-second-level">
                        @can('ticket-list')
                        <li class="side-nav-item">
                            <a class="side-nav-link" href="{{ route('tickets.index') }}">{{__('translation.Manage support tickets')}}</a>
                        </li>
                        @endcan


                        @can('ticket-my')

                        <li class="side-nav-item">
                            <a class="side-nav-link" href="{{ route('tickets.me') }}">{{__('translation.My support tickets')}}</a>
                        </li>
                        @endcan



                    </ul>
                </div>
            </li>

            @endcan

            

            {{-- <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarLayouts" aria-expanded="false" aria-controls="sidebarLayouts" class="side-nav-link">
                            <i class="ri-layout-line"></i>
                            <span class="badge bg-warning float-end">New</span>
                            <span> Dashboard Affects </span>
                        </a>
                        <div class="collapse" id="sidebarLayouts">
                            <ul class="side-nav-second-level">
                                <li class="side-nav-item">
                                    <a class="side-nav-link" href="dashboardEffect" target="_blank">Light Sidebar</a>
                                </li>
                                <li class="side-nav-item">
                                    <a class="side-nav-link" href="layouts-sm-sidebar" target="_blank">Small Sidebar</a>
                                </li>
                                <li class="side-nav-item">
                                    <a class="side-nav-link" href="layouts-collapsed-sidebar.html" target="_blank">Collapsed Sidebar</a>
                                </li>
                                <li class="side-nav-item">
                                    <a class="side-nav-link" href="layouts-unsticky-layout.html" target="_blank">Unsticky Layout</a>
                                </li>
                                <li class="side-nav-item">
                                    <a class="side-nav-link" href="layouts-boxed.html" target="_blank">Boxed Layout</a>
                                </li>
                            </ul>
                        </div>
                    </li> --}}

            {{-- <li class="side-nav-item">
                        <a href="Documentation/index.html" class="side-nav-link">
                            <i class="ri-article-line"></i>
                            <span> Documentaions</span>

                        </a>
                    </li> --}}

            <li class="side-nav-item">
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" class="side-nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="ri-logout-box-line"></i>
                    <span> {{__('translation.Logout')}}</span>
                </a>
            </li>


        </ul>
    </div>
</div>
