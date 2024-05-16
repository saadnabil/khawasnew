	<div class="navbar-custom">
	    <div class="topbar container-fluid">
	        <div class="d-flex align-items-center gap-1">

	            <!-- Topbar Brand Logo -->
	            <div class="logo-topbar">
	                <!-- Logo light -->
	                <a href="index.html" class="logo-light">
	                    <span class="logo-lg">
	                        <img src="{{asset('assets/images/tree logo.png')}}" alt="logo">
	                    </span>
	                    <span class="logo-sm">
	                        <img src="{{asset('assets/images/tree logo.png')}}" alt="small logo">
	                    </span>
	                </a>

	                <!-- Logo Dark -->
	                <a href="index.html" class="logo-dark">
	                    <span class="logo-lg">
	                        <img src="{{asset('assets/images/tree logo.png')}}" alt="dark logo">
	                    </span>
	                    <span class="logo-sm">
	                        <img src="{{asset('assets/images/tree logo.png')}}" alt="small logo">
	                    </span>
	                </a>
	            </div>

	            <!-- Sidebar Menu Toggle Button -->
	            <button class="button-toggle-menu">
	                <i class="mdi mdi-menu"></i>
	            </button>

	            <!-- Page Title -->
	            <h4 class="page-title d-none d-sm-block">Dashboards</h4>
	        </div>

	        <ul class="topbar-menu d-flex align-items-center gap-3">
	            <li class="dropdown d-lg-none">
	                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
	                    <i class="mdi mdi-magnify fs-2"></i>
	                </a>
	                <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
	                    <form class="p-3">
	                        <input type="search" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
	                    </form>
	                </div>
	            </li>

	            <li class="dropdown">
	                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
	                    <img src="{{asset('assets/images/flags/us.jpg')}}" alt="user-image" class="me-0 me-sm-1" height="12">
	                    <span class="align-middle d-none d-lg-inline-block">English</span>
	                    <span class="mdi mdi-chevron-down fs-22 d-none d-sm-inline-block align-middle"></span>

	                </a>
	                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">

	                    <!-- item-->
	                    <a href="javascript:void(0);" class="dropdown-item">
	                        <img src="{{asset('assets/images/flags/germany.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
	                    </a>

	                    <!-- item-->
	                    <a href="javascript:void(0);" class="dropdown-item">
	                        <img src="{{asset('assets/images/flags/italy.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
	                    </a>

	                    <!-- item-->
	                    <a href="javascript:void(0);" class="dropdown-item">
	                        <img src="{{asset('assets/images/flags/spain.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
	                    </a>

	                    <!-- item-->
	                    <a href="javascript:void(0);" class="dropdown-item">
	                        <img src="{{asset('assets/images/flags/russia.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
	                    </a>

	                </div>
	            </li>
	            <!--cart-->
	            @include('layout.UserCart')




	            <li class="dropdown notification-list">
	                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
	                    <i class="ri-mail-line fs-22"></i>

	                    <span class="noti-icon-badge badge text-bg-purple">4</span>
	                </a>
	                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
	                    <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
	                        <div class="row align-items-center">
	                            <div class="col">
	                                <h6 class="m-0 fs-16 fw-semibold"> Messages</h6>
	                            </div>
	                            <div class="col-auto">
	                                <a href="javascript: void(0);" class="text-dark text-decoration-underline">
	                                    <small>Clear All</small>
	                                </a>
	                            </div>
	                        </div>
	                    </div>

	                    <div style="max-height: 300px;" data-simplebar>

	                        <!-- item-->
	                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item read-noti card m-0 shadow-none">
	                            <div class="card-body">
	                                <div class="d-flex align-items-center">
	                                    <div class="flex-shrink-0">
	                                        <div class="notify-icon">
	                                            <img src="{{asset('assets/images/users/avatar-1.jpg')}}" class="img-fluid rounded-circle" alt />
	                                        </div>
	                                    </div>
	                                    <div class="flex-grow-1 text-truncate ms-2">
	                                        <h5 class="noti-item-title fw-semibold fs-14">Cristina Pride <small class="fw-normal text-muted float-end ms-1">1 day
	                                                ago</small></h5>
	                                        <small class="noti-item-subtitle text-muted">Hi, How are you? What
	                                            about our
	                                            next meeting</small>
	                                    </div>
	                                </div>
	                            </div>
	                        </a>

	                        <!-- item-->
	                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item read-noti card m-0 shadow-none">
	                            <div class="card-body">
	                                <div class="d-flex align-items-center">
	                                    <div class="flex-shrink-0">
	                                        <div class="notify-icon">
	                                            <img src="{{asset('assets/images/users/avatar-2.jpg')}}" class="img-fluid rounded-circle" alt />
	                                        </div>
	                                    </div>
	                                    <div class="flex-grow-1 text-truncate ms-2">
	                                        <h5 class="noti-item-title fw-semibold fs-14">Sam Garret <small class="fw-normal text-muted float-end ms-1">2 day
	                                                ago</small></h5>
	                                        <small class="noti-item-subtitle text-muted">Yeah everything is
	                                            fine</small>
	                                    </div>
	                                </div>
	                            </div>
	                        </a>

	                        <!-- item-->
	                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item read-noti card m-0 shadow-none">
	                            <div class="card-body">
	                                <div class="d-flex align-items-center">
	                                    <div class="flex-shrink-0">
	                                        <div class="notify-icon">
	                                            <img src="{{asset('assets/images/users/avatar-3.jpg')}}" class="img-fluid rounded-circle" alt />
	                                        </div>
	                                    </div>
	                                    <div class="flex-grow-1 text-truncate ms-2">
	                                        <h5 class="noti-item-title fw-semibold fs-14">Karen Robinson <small class="fw-normal text-muted float-end ms-1">2 day
	                                                ago</small></h5>
	                                        <small class="noti-item-subtitle text-muted">Wow that's
	                                            great</small>
	                                    </div>
	                                </div>
	                            </div>
	                        </a>

	                        <!-- item-->
	                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item read-noti card m-0 shadow-none">
	                            <div class="card-body">
	                                <div class="d-flex align-items-center">
	                                    <div class="flex-shrink-0">
	                                        <div class="notify-icon">
	                                            <img src="{{asset('assets/images/users/avatar-4.jpg')}}" class="img-fluid rounded-circle" alt />
	                                        </div>
	                                    </div>
	                                    <div class="flex-grow-1 text-truncate ms-2">
	                                        <h5 class="noti-item-title fw-semibold fs-14">Sherry Marshall
	                                            <small class="fw-normal text-muted float-end ms-1">3 day
	                                                ago</small></h5>
	                                        <small class="noti-item-subtitle text-muted">Hi, How are you? What
	                                            about our
	                                            next meeting</small>
	                                    </div>
	                                </div>
	                            </div>
	                        </a>

	                        <!-- item-->
	                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item read-noti card m-0 shadow-none">
	                            <div class="card-body">
	                                <div class="d-flex align-items-center">
	                                    <div class="flex-shrink-0">
	                                        <div class="notify-icon">
	                                            <img src="{{asset('assets/images/users/avatar-5.jpg')}}" class="img-fluid rounded-circle" alt />
	                                        </div>
	                                    </div>
	                                    <div class="flex-grow-1 text-truncate ms-2">
	                                        <h5 class="noti-item-title fw-semibold fs-14">Shawn Millard <small class="fw-normal text-muted float-end ms-1">4 day
	                                                ago</small></h5>
	                                        <small class="noti-item-subtitle text-muted">Yeah everything is
	                                            fine</small>
	                                    </div>
	                                </div>
	                            </div>
	                        </a>
	                    </div>

	                    <!-- All-->
	                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary text-decoration-underline fw-bold notify-item border-top border-light py-2">
	                        View All
	                    </a>

	                </div>
	            </li>



	            <li class="d-none d-sm-inline-block">
	                <a class="nav-link" data-bs-toggle="offcanvas" href="#theme-settings-offcanvas">
	                    <span class="ri-settings-3-line fs-22"></span>
	                </a>
	            </li>

	            <li class="d-none d-sm-inline-block">
	                <div class="nav-link" id="light-dark-mode">
	                    <i class="ri-moon-line fs-22"></i>
	                </div>
	            </li>

	            <li class="dropdown">
	                <a class="nav-link dropdown-toggle arrow-none nav-user" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
	                    <span class="account-user-avatar">
	                        <img src="{{asset('assets/images/users/avatar-1.jpg')}}" alt="user-image" width="32" class="rounded-circle">
	                    </span>
	                    <span class="d-lg-block d-none">
	                        <h5 class="my-0 fw-normal">{{Auth::guard('web')->user()->name }}<i class="ri-arrow-down-s-line fs-22 d-none d-sm-inline-block align-middle"></i></h5>
	                    </span>
	                </a>
	                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
	                    <!-- item-->
	                    <!-- <div class=" dropdown-header noti-title">
									<h6 class="text-overflow m-0">Welcome  !</h6>
									
                                    </a>
								</div> -->

	                    <!-- item-->

	                    <!-- item-->
	                    <a href="pages-profile.html" class="dropdown-item">
	                        <i class="ri-settings-4-line fs-16 align-middle me-1"></i>
	                        <span>Settings</span>
	                    </a>




	                    <!-- item-->
	                    <form action="{{route('user.logout')}}" method="post">
	                        @csrf
	                        <button type="submit" class="dropdown-item">
	                            <i class="ri-logout-circle-r-line align-middle me-1"></i>
	                            <span>Logout</span>
	                        </button>
	                    </form>
	                </div>
	            </li>
	        </ul>
	    </div>
	</div>
