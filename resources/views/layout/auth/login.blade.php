<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In | Admins Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS, ERP etc." name="description" />
    <meta content="Techzaa" name="author" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Add SweetAlert2 script -->

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/tree logo.png')}}">

    <!-- Theme Config Js -->
    <script src="{{asset('assets/js/config.js')}}"></script>

    <!-- App css -->
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
</head>
@php
$flagArr = [
'en' => asset('assets/images/flags/us.jpg'),
'ar' => asset('assets/images/flags/Download_Saudi_Arabia_National_Flag_Illustration_Editable_Vector_Image_for_free.jpg'),
'de' => asset('assets/images/flags/germany.jpg'),
];
@endphp
<body class="authentication-bg position-relative" style="height: 100vh;">
    <div class="account-pages p-4 position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-8 col-lg-10">
                    <div class="card overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="d-flex justify-content-end p-3">
                                    <ul class="navbar-nav">
                                        <li class="dropdown">
                                            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                <img src="{{ $flagArr[app()->getLocale()] }}" alt="user-image" class="me-0 me-sm-1" height="12">
                                                <span class="align-middle d-none d-lg-inline-block">{{ __('translation.' . app()->getLocale()) }}</span>
                                                <span class="mdi mdi-chevron-down fs-22 d-none d-sm-inline-block align-middle"></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">
                                                <a href="{{ route('changelang', ['lang' => 'de']) }}" class="dropdown-item">
                                                    <img src="{{asset('assets/images/flags/germany.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                                                </a>
                                                <a href="{{ route('changelang', ['lang' => 'en']) }}" class="dropdown-item">
                                                    <img src="{{asset('assets/images/flags/us.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">English</span>
                                                </a>
                                                <a href="{{ route('changelang', ['lang' => 'ar']) }}" class="dropdown-item">
                                                    <img src="{{asset('assets/images/flags/Download_Saudi_Arabia_National_Flag_Illustration_Editable_Vector_Image_for_free.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Arabic</span>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="d-flex flex-column h-100">
                                    <div class="auth-brand p-3 text-center">
                                        <a href="" class="logo-light">
                                            <img src="{{asset('assets/images/tree logo.png')}}" alt="logo" height="80">
                                        </a>
                                        <a href="" class="logo-dark">
                                            <img src="{{asset('assets/images/tree logo.png')}}" alt="dark logo" height="80">
                                        </a>
                                    </div>

                                    <div class="p-3 text-center">
                                        <h4 class="fs-20 mb-2">{{__('translation.Login')}}</h4>
                                        <p class="text-muted mb-3">{{__('translation.Enter your email address | Phone')}}</p>

                                        <form action="{{ $route }}" class="text-start" method="POST">
                                            @csrf

                                            @if ($errors->any())
                                            <div>
                                                <ul class="alert alert-danger">
                                                    @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endif

                                            <div class="mb-3">
                                                <label for="emailaddress" class="form-label">{{__('translation.Enter your email address | Phone')}}</label>
                                                <input name="login" class="form-control" type="text" id="emailaddress" required placeholder="{{__('translation.Enter your email address | Phone')}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">{{__('translation.Password')}}</label>
                                                <input name="password" class="form-control" type="password" required id="password" placeholder="{{__('translation.Password')}}">
                                            </div>
                                            <a href="{{route('password.request')}}" class="text-muted float-end"><small>{{__('translation.Forgot your password?')}}</small></a>
                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="checkbox-signin">
                                                    <label class="form-check-label" for="checkbox-signin">{{__('translation.Remember me')}}</label>
                                                </div>
                                            </div>
                                            <div class="mb-0 text-start">
                                                <button class="btn btn-soft-primary w-100" type="submit" id="">
                                                    <i class="ri-login-circle-fill me-1"></i>
                                                    <span class="fw-bold">{{ __('translation.Login') }}</span>
                                                    <span class="indicator-progress" style="display: none;">
                                                        {{ __('Please wait...') }} <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                    </span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="{{asset('assets/images/bg_login2.jpg')}}" alt="" class="img-fluid rounded h-100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    document.getElementById('loginButton').addEventListener('click', function() {
        // Show the loading indicator
        var button = this;
        var indicator = button.querySelector('.indicator-progress');
        var buttonText = button.querySelector('span.fw-bold');

        buttonText.style.display = 'none';
        indicator.style.display = 'inline-flex';

        // Simulate a login request (Replace this with your actual login logic)
        setTimeout(function() {
            // Hide the loading indicator
            indicator.style.display = 'none';
            buttonText.style.display = 'inline-flex';

            // Simulate login response (true for success, false for failure)
            var loginSuccessful = false; // Change this to simulate success or failure

            if (loginSuccessful) {
                // Show SweetAlert success message
               Swal.fire({
                    icon: 'success',
                    title: '{{ __("Login successful") }}',
                    text: '{{ __("You have logged in successfully.") }}',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to the dashboard
                        window.location.href = '{{ route('admin.dashboard.index') }}';
                    }
                });

                
            } else {
                // Show SweetAlert error message
                Swal.fire({
                    icon: 'error',
                    title: '{{ __("Login failed") }}',
                    text: '{{ __("Incorrect phone number or password. Please try again.") }}',
                    confirmButtonText: 'OK'
                });

               
            }
        }, 2000); // Simulate a delay for login processing
    });
</script>

    <!-- Vendor js -->
    <script src="{{asset('assets/js/vendor.min.js')}}"></script>
    <script src="assets/vendor/lucide/umd/lucide.min.js"></script>
    <!-- App js -->
    <script src="assets/js/app.min.js"></script>
</body>

</html>
