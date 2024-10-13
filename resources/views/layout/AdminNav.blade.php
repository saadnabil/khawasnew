<div class="navbar-custom">
    <div class="topbar container-fluid">
        <div class="d-flex align-items-center gap-1">

            <!-- Topbar Brand Logo -->
            <div class="logo-topbar">
                <!-- Logo light -->
                <a href="" class="logo-light">
                    <span class="logo-lg">
                        <img src="{{asset('assets/images/tree logo.png')}}" alt="logo">
                    </span>
                    <span class="logo-sm">
                        <img src="{{asset('assets/images/tree logo.png')}}" alt="small logo">
                    </span>
                </a>

                <!-- Logo Dark -->
                <a href="" class="logo-dark">
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

            @php
            use App\Models\Order;
            $query = Order::with('order_details.item', 'address', 'coupon', 'user')->where('status', 'pending')->latest();

            if (request()->has('status')) {
            $query->where('status', request('status'));
            }

            $orders = $query->paginate(7);
            $status = request()->has('status') ? request('status') : 'all';
            @endphp

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="ri-shopping-cart-line fs-22"></i>
                    <span class="noti-icon-badge badge text-bg-danger">{{$orders->total()}}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                    <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0 fs-16 fw-semibold">Orders Incoming</h6>
                            </div>
                            <!-- Uncomment this section if you want to add a 'Clear All' button -->
                            <!-- <div class="col-auto">
                <a href="javascript: void(0);" class="text-dark text-decoration-underline">
                    <small>Clear All</small>
                </a>
            </div> -->
                        </div>
                    </div>


                    <div style="max-height: 300px;" data-simplebar>

                        <div id="alertsDiv">

                            @include('layout.adminNav-orders')

                        </div>


                    </div>

                    <!-- All-->
                    <a href="{{route('admin.orders.index')}}" class="dropdown-item text-center text-primary text-decoration-underline fw-bold notify-item border-top border-light py-2">
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



          @php
    $currentUser = auth()->guard('admin')->user(); 
@endphp

<li class="nav-item dropdown ">
    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        @if ($currentUser && $currentUser->image)
        <img src="{{ asset('storage/' . $currentUser->image) }}" alt="user-image" width="32" class="rounded-circle me-2">
        @endif
        <span>{{ Auth::guard('admin')->user()->name }}</span>
    </a>

    <ul class="dropdown-menu dropdown-menu-end profile-dropdown shadow" aria-labelledby="navbarDropdown">
        <li class="dropdown-header  d-flex">
            @if ($currentUser && $currentUser->image)
            <img src="{{ asset('storage/' . $currentUser->image) }}"
             alt="user-image" width="50" height="50" class="rounded-circle mb-2">
            @endif
            <div>
                <span class="fw-bold m-3">{{ Auth::guard('admin')->user()->name }}</span>
                <br>
                <small class="text-muted m-3">{{ Auth::guard('admin')->user()->email }}</small>
            </div>
        </li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item d-flex align-items-center" href="{{ route('admins.index') }}">
            <i class="ri-user-line me-2"></i>{{__("translation.Profile")}}
        </a></li>
        <li><a class="dropdown-item d-flex align-items-center" href="#">
            <i class="ri-mail-line me-2"></i>{{__('translation.message')}}
        </a></li>
        
        <li><a class="dropdown-item d-flex align-items-center" href="{{ route('admins.index') }}">
            <i class="ri-settings-4-line me-2"></i>{{ __('translation.Settings') }}
        </a></li>
        <li>
            <form action="{{ route('admin.logout') }}" method="post" class="dropdown-item m-0 px-3">
                @csrf
                <button type="submit" class="btn btn-link dropdown-item text-danger d-flex align-items-center">
                    <i class="ri-logout-circle-r-line me-2"></i>{{ __('translation.Log Out') }}
                </button>
            </form>
        </li>
    </ul>
</li>

<style>
    .profile-dropdown {
        width: 250px;
    }

    .profile-dropdown .dropdown-header {
        padding: 1rem;
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
    }

    .profile-dropdown .dropdown-header img {
        border-radius: 50%;
    }

    .profile-dropdown .dropdown-item {
        display: flex;
        align-items: center;
        padding: 0.5rem 1rem;
    }

    .profile-dropdown .dropdown-item i {
        margin-right: 0.5rem;
        font-size: 18px;
    }

    .profile-dropdown .dropdown-item:hover {
        background-color: #f1f1f1;
    }

    .profile-dropdown .dropdown-divider {
        margin: 0;
    }

    .profile-dropdown .btn-link {
        color: inherit;
        padding: 0;
    }

    .profile-dropdown .text-danger {
        color: #d9534f;
    }
</style>







        </ul>
    </div>
</div>



<style>
    @keyframes beat {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.2);
        }
    }

    .noti-icon-badge {
        display: inline-block;
        animation: beat 1s infinite;
    }

</style>

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let previousCount = 0;

        function fetchPendingOrders() {
            fetch("{{ route('admin.pending-orders') }}", {
                    headers: {
                        'Accept': 'application/json'
                        , 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.text();
                })
                .then(text => {
                    const data = JSON.parse(text);
                    const newCount = data.total;
                    if (newCount == 0) {
                        return;
                    }
                    document.querySelector('.noti-icon-badge').textContent = newCount;

                    Swal.fire({
                        title: 'New Order!'
                        , text: 'You have new pending orders.'
                        , icon: 'info'
                        , confirmButtonText: 'OK'
                    });
                    var audio = new Audio('{{ asset('
                        assets / alert.ogg ') }}');
                    audio.play().catch(error => {
                        console.error('Error playing audio:', error);
                    });

                    previousCount = newCount;
                    updateOrdersList(data.html);
                })
                .catch(error => console.error('Error fetching orders:', error));
        }

        function updateOrdersList(html) {
            const ordersContainer = document.querySelector('#alertsDiv');
            ordersContainer.innerHTML = html;
        }

        setInterval(fetchPendingOrders, 10 * 1000);
    });

</script>
