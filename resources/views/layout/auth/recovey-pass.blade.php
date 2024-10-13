<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Recover Password </title>
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
                                        <h4 class="fs-20">Recovey Password?</h4>
                                        <p class="text-muted mb-3">Enter your New password.</p>


                                        <!-- form -->
                                        <form class="text-start" method="POST" action="{{ route('password.update') }}">
                                            @csrf
                                            <input type="hidden" name="token" value="{{ $token }}">


                                            <div class="mb-3">
                                                <label for="emailmail" class="form-label">Email </label>
                                                <input  class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus type="email" id="emailmail">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>



                                            <div class="mb-3">
                                                <label for="newpass" class="form-label">New Password</label>
                                                <input class="form-control @error('password') is-invalid @enderror" name="password" type="password" id="newpass" required="" placeholder="New Password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                            </div>




                                            <div class="mb-3">
                                                <label for="recpass" class="form-label">Confirm Password</label>
                                                <input class="form-control" name="password_confirmation" type="password" id="recpass" required="" placeholder="Confirm Password">
                                            </div>





                                            <div class="mb-0 text-start">
                                                <button class="btn btn-soft-primary w-100" type="submit">
                                                    <i class="ri-loop-left-line me-1 fw-bold"></i> <span class="fw-bold"> Confirm</span> </button>
                                            </div>
                                        </form>
                                        <!-- end form-->
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="assets/images/auth-bg-dark.jpg" alt="" class="img-fluid rounded h-100">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    {{-- <p class="text-dark-emphasis">Don't have an account? <a href="auth-register.html"
                            class="text-dark fw-bold ms-1 link-offset-3 text-decoration-underline"><b>Sign up</b></a>
                    </p> --}}
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt fw-medium">
        <span class="text-dark">
            <script>
                document.write(new Date().getFullYear())

            </script> © Webdiv - Theme by Mohammed Jameel
        </span>
    </footer>

    <!-- Vendor js -->
    <script src="{{asset('assets/js/vendor.min.js')}}"></script>









    <script src="{{asset('assets/vendor/lucide/umd/lucide.min.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('assets/js/app.min.js')}}"></script>

</body>

</html>
