<div class="leftside-menu">

            <!-- Logo Light -->
            <a href="index.html" class="logo logo-light">
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
            <a href="index.html" class="logo logo-dark">
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
                    <li class="side-nav-title">Main</li>

                    <li class="side-nav-item">
                        <a href="{{route('admin.dashboard.index')}}" class="side-nav-link">
                            <i class="ri-dashboard-2-line"></i>
                            <span> Dashboard </span>
                            <!-- <span class="badge bg-success float-end">9+</span> -->
                        </a>
                    </li>

                    <li class="side-nav-title">Products</li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#products" aria-expanded="false" aria-controls="products" class="side-nav-link">
                            <i class="ri-shopping-bag-line"></i>
                            <span>Products</span>
                            <span class="menu-arrow"></span>

                        </a>
                        <div class="collapse" id="products">
                            <ul class="side-nav-second-level">
                                <li class="side-nav-item">
                                    <a class="side-nav-link" href="{{route('admin.items.index')}}">Product List</a>
                                </li>
                                <li class="side-nav-item">
                                    <a class="side-nav-link" href="{{route('admin.itemtypes.index')}}">Product Type</a>
                                </li>
                                <li class="side-nav-item">
                                    <a class="side-nav-link" href="{{route('admin.itemtaxes.index')}}">Product Tax</a>
                                </li>
                            </ul>
                        </div>
                    </li>


                    <li class="side-nav-title">Orders</li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#order" aria-expanded="false" aria-controls="order" class="side-nav-link">
                            <i class="ri-shopping-basket-line"></i>
                            <span> Orders </span>
                            <span class="menu-arrow"></span>

                        </a>
                        <div class="collapse" id="order">
                            <ul class="side-nav-second-level">
                                <li class="side-nav-item">
                                    <a class="side-nav-link" href="order_list.html">Orders List</a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-title">Authantcations</li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#admins" aria-expanded="false" aria-controls="admins" class="side-nav-link">
                            <i class="ri-admin-line"></i>
                            <span> Admins Jobs </span>
                            <span class="menu-arrow"></span>

                        </a>
                        <div class="collapse" id="admins">
                            <ul class="side-nav-second-level">
                                <li class="side-nav-item">
                                    <a class="side-nav-link" href="admins_list.html">Admins List</a>
                                </li>
                                <li class="side-nav-item">
                                    <a class="side-nav-link" href="rolesPremission.html">Roles &
                                        Premisstions</a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#user" aria-expanded="false" aria-controls="user" class="side-nav-link">
                            <i class="ri-user-line"></i>
                            <span> Users </span>
                            <span class="menu-arrow"></span>

                        </a>
                        <div class="collapse" id="user">
                            <ul class="side-nav-second-level">
                                <li class="side-nav-item">
                                    <a class="side-nav-link" href="{{route('admin.users.index')}}">Users List</a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-title">Settings</li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#setting" aria-expanded="false" aria-controls="setting" class="side-nav-link">
                            <i class="ri-settings-3-line"></i>
                            <span> Settings </span>
                            <span class="menu-arrow"></span>

                        </a>
                        <div class="collapse" id="setting">
                            <ul class="side-nav-second-level">
                                <li class="side-nav-item">
                                    <a class="side-nav-link" href="{{route('ContactUs.index')}}">Contact Us</a>
                                </li>

                                <li class="side-nav-item">
                                    <a class="side-nav-link" href="ui-avatars.html">Chatting</a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-item">
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
                    </li>

                    <li class="side-nav-item">
                        <a href="Documentation/index.html" class="side-nav-link">
                            <i class="ri-article-line"></i>
                            <span> Documentaions</span>

                        </a>
                    </li>

                    <li class="side-nav-item">
                        <a href="{{route('admin.logout')}}" class="side-nav-link">
                            <i class="ri-logout-box-line"></i>
                            <span> Logout</span>

                        </a>
                    </li>

                </ul>
            </div>
        </div>