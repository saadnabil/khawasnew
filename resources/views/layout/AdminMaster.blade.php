<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
{{-- <html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"> --}}


<head>
    <meta charset="utf-8" />
    <link rel="manifest" href="{{ asset('manifest.json') }}">
<meta name="theme-color" content="#007bff">
    <title>Dashboard | Admin | Elkhawas Trade</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Elkhawas Trade" name="description" />
    <meta content="Elkhawas Trade" name="Elkhawas Trade" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/tree logo.png')}}">

    <!-- Daterangepicker css -->
    <link rel="stylesheet" href="{{asset('assets/vendor/daterangepicker/daterangepicker.css')}}">

    <!-- Vector Map css -->
    <link rel="stylesheet" href="{{asset('assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}">
    <link href="{{asset('assets/vendor/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Theme Config Js -->
    <script src="{{asset('assets/js/config.js')}}"></script>



    @if ( app()->getLocale() == "ar" )
    <link href="{{asset('assets/css/app-rtl.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />
    @else
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />
    @endif


    <!-- App css -->

    @stack('style')
    <!-- Icons css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('sweetalert::alert')
</head>


<style>
    .order-count-badge {
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 2px 8px;
        margin-left: 8px;
        font-size: 12px;
    }

</style>

<body>
    <!-- Begin page -->
    <div class="wrapper">

        <!-- ========== Topbar Start ========== -->
        @include('layout.AdminNav')
        <!-- ========== Topbar End ========== -->

        <!-- Left Sidebar Start -->
        @include('layout.AdminMenu')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                @yield('content')
                <!-- end container -->

                <!-- Footer Start -->
                @include('layout.footer')
                <!-- end Footer -->

            </div>
            <!-- content -->
        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- Theme Settings -->
    @include('layout.theme-settings')






    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])


    <!-- Vendor js -->
    <!-- Vendor js -->
    @include('layout.alert')

    <script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('/sw.js').then(function(registration) {
                console.log('Service Worker registered with scope:', registration.scope);
            }, function(err) {
                console.log('Service Worker registration failed:', err);
            });
        });
    }
</script>


    <script>
        const exampleModal = document.getElementById('exampleModal')
        exampleModal.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const recipient = button.getAttribute('data-bs-whatever')
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            const modalTitle = exampleModal.querySelector('.modal-title')
            const modalBodyInput = exampleModal.querySelector('.modal-body input')

            modalTitle.textContent = `New message to ${recipient}`
            modalBodyInput.value = recipient
        })

    </script>

    <script>
        // app.js

        document.addEventListener('DOMContentLoaded', function() {
            Echo.private('new-order')
                .listen('NewOrderReceived', (event) => {
                    // Update the badge count
                    var badge = document.querySelector('.noti-icon-badge');
                    var currentCount = parseInt(badge.textContent);
                    badge.textContent = currentCount + event.newOrderCount;
                });
        });

    </script>

    
    <script src="{{asset('assets/js/vendor.min.js')}}"></script>

    <script src="{{asset('assets/vendor/lucide/umd/lucide.min.js')}}"></script>

    <!-- Apex Charts js -->
    <script src="{{asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>

    <!-- Vector Map js -->
    <script src="{{asset('assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{asset('assets/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js')}}"></script>

    <!-- Dashboard App js -->
    <script src="{{asset('assets/js/pages/dashboard.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('assets/js/app.min.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>

    <script src="{{asset('assets/vendor/select2/js/select2.min.js ')}}"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('e031901264fc6b9cd120', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            app.messages.push(JSON.stringify(data));
        });

        // Vue application
        const app = new Vue({
            el: '#app'
            , data: {
                messages: []
            , }
        , });

    </script>


</body>

</html>
