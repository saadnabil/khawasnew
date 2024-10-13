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
	            <h4 class="page-title d-none d-sm-block">{{__('translation.Dashboard')}}</h4>
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




	            @php
	            $flagArr = [
	            'en' => asset('assets/images/flags/us.jpg'),
	            'ar' => asset('assets/images/flags/Download_Saudi_Arabia_National_Flag_Illustration_Editable_Vector_Image_for_free.jpg'),
	            'de' => asset('assets/images/flags/germany.jpg'),
	            ];
	            @endphp

	            <li class="dropdown">
	                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
	                    <img src="{{ $flagArr[app()->getLocale()] }}" alt="user-image" class="me-0 me-sm-1" height="12">
	                    <span class="align-middle d-none d-lg-inline-block">{{ __('translation.' . app()->getLocale()) }}</span>
	                    <span class="mdi mdi-chevron-down fs-22 d-none d-sm-inline-block align-middle"></span>

	                </a>
	                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">

	                    <!-- item-->
	                    <a href="{{ route('changelang', ['lang' => 'de']) }}" class="dropdown-item">
	                        <img src="{{asset('assets/images/flags/germany.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
	                    </a>

	                    <!-- item-->
	                    <a href="{{ route('changelang', ['lang' => 'en']) }}" class="dropdown-item">
	                        <img src="{{asset('assets/images/flags/us.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">English</span>
	                    </a>



	                    <!-- item-->
	                    <a href="{{ route('changelang', ['lang' => 'ar']) }}" class="dropdown-item">
	                        <img src="{{asset('assets/images/flags/Download_Saudi_Arabia_National_Flag_Illustration_Editable_Vector_Image_for_free.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Arabic</span>
	                    </a>

	                </div>
	            </li>
	            <!--cart-->

	            @if(!in_array(request()->url() , [route('carts.details'), route('carts.checkoutform')]))
	            <section class="" id="usercart" style="">
	                @include('layout.UserCart')
	            </section>
	            @endif




	            {{-- <li class="dropdown notification-list">
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
	            </li> --}}



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

	            @php
	            $currentUser = auth()->guard('web')->user(); // Get the currently authenticated user
	            @endphp



	            <li class="nav-item dropdown">
	                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
	                    @if ($currentUser && $currentUser->image)
	                    <img src="{{ asset('storage/' . $currentUser->image) }}" alt="user-image" width="32" class="rounded-circle me-2">
	                    @endif

	                    <span>{{ Auth::guard('web')->user()->name }}</span>
	                    {{-- <i class="ri-arrow-down-s-line fs-22 ms-2"></i> --}}
	                </a>

	                <ul class="dropdown-menu dropdown-menu-end profile-dropdown" aria-labelledby="navbarDropdown">
	                    <li>
	                        <div class="card border-0" style="width: 18rem;">
	                            <div class="card-body p-0">
	                                <div class="row m-0 mt-3 p-0 align-items-center">
	                                    <div class="col-3 m-0 p-0 text-center">
	                                        @if ($currentUser && $currentUser->image)
	                                        <img src="{{ asset('storage/' . $currentUser->image) }}" alt="user-image" class="rounded-circle" width="50px" height="50px">
	                                        @endif
	                                    </div>
	                                    <div class="col-9 m-0 p-0">
	                                        <h5 class="card-title m-0">{{ Auth::guard('web')->user()->name }}</h5>
	                                        <h6 class="card-subtitle mb-2 text-muted m-0">{{ Auth::guard('web')->user()->phone }} </h6>
	                                    </div>
	                                </div>

	                                <hr>

	                                <div class="list-group m-0">
	                                    <a href="{{route('user.UserShowPassword')}}" class="list-group-item border-0 list-group-item-action">
	                                        <i class="ri-settings-4-line fs-16 align-middle me-1"></i>{{__('translation.Settings')}}
	                                    </a>
	                                    <form action="{{ route('user.logout') }}" method="post" class="m-0">
	                                        @csrf
	                                        <button type="submit" class="list-group-item border-0 list-group-item-action text-danger">
	                                            <i class="ri-logout-circle-r-line align-middle me-1"></i>{{__('translation.Log Out')}}
	                                        </button>
	                                    </form>
	                                </div>
	                            </div>
	                        </div>
	                    </li>
	                </ul>
	            </li>
	        </ul>
	    </div>
	</div>
