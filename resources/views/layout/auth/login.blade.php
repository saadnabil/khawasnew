<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In | Admins Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/tree logo.png')}}">

    <!-- Theme Config Js -->
    <script src="{{asset('assets/js/config.js')}}"></script>

    <!-- App css -->
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg position-relative" style="height: 100vh;">
    <div class="account-pages p-sm-5  position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-9 col-lg-11">
                    <div class="card overflow-hidden">
                        <div class="row g-0">


                            <div class="col-lg-6">
                                <div class="d-flex flex-column h-100">
                                    <div class="auth-brand p-4 text-center">
                                        <a href="index.html" class="logo-light">
                                            <img src="{{asset('assets/images/tree logo.png')}}" alt="logo" height="100">
                                        </a>
                                        <a href="index.html" class="logo-dark">
                                            <img src="{{asset('assets/images/tree logo.png')}}" alt="dark logo" height="100">
                                        </a>
                                    </div>
                                    <div class="p-4 my-auto text-center">
                                        <h4 class="fs-20">Sign In</h4>
                                        <p class="text-muted mb-4">Enter your email address | Phone
                                        </p>

                                        <!-- form -->
                                        <form action="{{ $route }}" class="text-start" method="post">
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
                                                <label for="emailaddress" class="form-label">Enter your phone or email</label>
                                                <input name="login" class="form-control" type="text" id="emailaddress" required="" placeholder="Enter your phone or email">
                                            </div>
                                            <div class="mb-3">

                                                <label for="password" class="form-label">Password</label>
                                                <input name="password" class="form-control" type="password" required="" id="password" placeholder="Enter your password">
                                            </div>
                                            <a href="" class="text-muted float-end"><small>Forgot
                                                    your
                                                    password?</small></a>
                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="checkbox-signin">
                                                    <label class="form-check-label" for="checkbox-signin">Remember
                                                        me</label>
                                                </div>
                                            </div>
                                            <div class="mb-0 text-start">
                                                <button class="btn btn-soft-primary w-100" type="submit"><i class="ri-login-circle-fill me-1"></i> <span class="fw-bold">Log
                                                        In</span> </button>
                                            </div>


                                        </form>
                                        <!-- end form-->
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="{{asset('assets/images/auth-bg-dark.jpg')}} " alt="" class="img-fluid rounded h-100">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>

            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->



    <!-- Vendor js -->
    <script src="{{asset('assets/js/vendor.min.js')}}"></script>









    <script src="assets/vendor/lucide/umd/lucide.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>

</html>
