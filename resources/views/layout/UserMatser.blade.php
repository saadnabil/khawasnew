<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8" />
		<title>Dashboard | Users | Elkhawas Trade</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta content="Elkhawas Trade" name="description" />
		<meta content="Elkhawas Trade" name="Elkhawas Trade" />

		<!-- App favicon -->
		<link rel="shortcut icon" href="{{asset('assets/images/tree logo.png')}}">

		<!-- Daterangepicker css -->
		<link rel="stylesheet"
			href="{{asset('assets/vendor/daterangepicker/daterangepicker.css')}}">

		<!-- Vector Map css -->
		<link rel="stylesheet"
			href="{{asset('assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}">

		<!-- Theme Config Js -->
		<script src="{{asset('assets/js/config.js')}}"></script>

		<!-- App css -->
	@if ( app()->getLocale() == "ar" )
    <link href="{{asset('assets/css/app-rtl.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

    @else
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />
    @endif

		<!-- Icons css -->
		<link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
		    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	</head>

<style>

.card.hover-effect {
    transition: transform 0.3s, box-shadow 0.3s;
}

.card.hover-effect:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.img-overlay {
    position: relative;
}

.img-overlay img {
    display: block;
    width: 100%;
    height: 150px;
    object-fit: cover;
}

.out-of-stock-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 1.5em;
    font-weight: bold;
}

.pt-4 {
    padding-top: 1.5rem !important;
}

.mb-1 {
    margin-bottom: 0.25rem !important;
}

.mb-2 {
    margin-bottom: 0.5rem !important;
}

.border-top {
    border-top: 1px solid #dee2e6 !important;
}

.border-dark-subtle {
    border-color: rgba(0, 0, 0, 0.1) !important;
}

.pt-2 {
    padding-top: 0.5rem !important;
}

.text-center {
    text-align: center !important;
}

.list-unstyled {
    padding-left: 0;
    list-style: none;
}

.btn-primary {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}

.btn-light {
    color: #212529;
    background-color: #f8f9fa;
    border-color: #f8f9fa;
}

.text-danger {
    color: #dc3545 !important;
}

.ml-2 {
    margin-left: 0.5rem !important;
}
</style>

  @stack('style')

	<body>
	 @include('sweetalert::alert')
		<!-- Begin page -->
		<div class="wrapper">

			<!-- ========== Topbar Start ========== -->
		@include('layout.UserNavbar')
			<!-- ========== Topbar End ========== -->

			<!-- Left Sidebar Start -->
		@include('layout.UserMenu')
			<!-- Left Sidebar End -->

			<!-- ============================================================== -->
			<!-- Start Page Content here -->
			<!-- ============================================================== -->

			<div class="content-page">
				<div class="content">

					<!-- Start Content-->
					<div class="container-fluid">

               @yield('content')



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
		<div class="offcanvas offcanvas-end" tabindex="-1"
			id="theme-settings-offcanvas">
			<div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
				<h5 class="text-white m-0">Theme Settings</h5>
				<button type="button" class="btn-close btn-close-white ms-auto"
					data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>

			<div class="offcanvas-body p-0">
				<div data-simplebar class="h-100">
					<div class="p-3">
						<h5 class="mb-3 fs-16 fw-semibold">Color Scheme</h5>

						<div class="row">
							<div class="col-6">
								<div class="form-check mb-1">
									<input class="form-check-input border-secondary" type="radio"
										name="data-bs-theme" id="layout-color-light" value="light">
									<label class="form-check-label" for="layout-color-light">Light</label>
								</div>
							</div>

							<div class="col-6">
								<div class="form-check mb-1">
									<input class="form-check-input border-secondary" type="radio"
										name="data-bs-theme" id="layout-color-dark" value="dark">
									<label class="form-check-label" for="layout-color-dark">Dark</label>
								</div>
							</div>
						</div>

						<div id="layout-width">
							<h5 class="my-3 fs-16 fw-semibold">Layout Mode</h5>

							<div class="row">
								<div class="col-6">
									<div class="form-check mb-1">
										<input class="form-check-input border-secondary" type="radio"
											name="data-layout-mode" id="layout-mode-fluid" value="fluid">
										<label class="form-check-label" for="layout-mode-fluid">Fluid</label>
									</div>
								</div>

								<div class="col-6">
									<div id="layout-boxed">
										<div class="form-check mb-1">
											<input class="form-check-input border-secondary" type="radio"
												name="data-layout-mode" id="layout-mode-boxed" value="boxed">
											<label class="form-check-label" for="layout-mode-boxed">Boxed</label>
										</div>
									</div>
								</div>
							</div>
						</div>

						<h5 class="my-3 fs-16 fw-semibold">Topbar Color</h5>

						<div class="row">
							<div class="col-6">
								<div class="form-check mb-1">
									<input class="form-check-input border-secondary" type="radio"
										name="data-topbar-color" id="topbar-color-light" value="light">
									<label class="form-check-label" for="topbar-color-light">Light</label>
								</div>
							</div>

							<div class="col-6">
								<div class="form-check mb-1">
									<input class="form-check-input border-secondary" type="radio"
										name="data-topbar-color" id="topbar-color-dark" value="dark">
									<label class="form-check-label" for="topbar-color-dark">Dark</label>
								</div>
							</div>
						</div>

						<div>
							<h5 class="my-3 fs-16 fw-semibold">Menu Color</h5>

							<div class="row">
								<div class="col-6">
									<div class="form-check mb-1">
										<input class="form-check-input border-secondary" type="radio"
											name="data-menu-color" id="leftbar-color-light" value="light">
										<label class="form-check-label"
											for="leftbar-color-light">Light</label>
									</div>
								</div>

								<div class="col-6">
									<div class="form-check mb-1">
										<input class="form-check-input border-secondary" type="radio"
											name="data-menu-color" id="leftbar-color-dark" value="dark">
										<label class="form-check-label" for="leftbar-color-dark">Dark</label>
									</div>
								</div>
							</div>
						</div>

						<div id="sidebar-size">
							<h5 class="my-3 fs-16 fw-semibold">Sidebar Size</h5>

							<div class="row gap-2">
								<div class="col-12">
									<div class="form-check mb-1">
										<input class="form-check-input border-secondary" type="radio"
											name="data-sidenav-size" id="leftbar-size-default" value="default">
										<label class="form-check-label"
											for="leftbar-size-default">Default</label>
									</div>
								</div>

								<div class="col-12">
									<div class="form-check mb-1">
										<input class="form-check-input border-secondary" type="radio"
											name="data-sidenav-size" id="leftbar-size-compact" value="compact">
										<label class="form-check-label"
											for="leftbar-size-compact">Compact</label>
									</div>
								</div>

								<div class="col-12">
									<div class="form-check mb-1">
										<input class="form-check-input border-secondary" type="radio"
											name="data-sidenav-size" id="leftbar-size-small" value="condensed">
										<label class="form-check-label"
											for="leftbar-size-small">Condensed</label>
									</div>
								</div>

								<div class="col-12">
									<div class="form-check mb-1">
										<input class="form-check-input border-secondary" type="radio"
											name="data-sidenav-size" id="leftbar-size-full" value="full">
										<label class="form-check-label" for="leftbar-size-full">Full
											Layout</label>
									</div>
								</div>
							</div>
						</div>

						<div id="layout-position">
							<h5 class="my-3 fs-16 fw-semibold">Layout Position</h5>

							<div class="row">
								<div class="col-6">
									<div class="form-check">
										<input type="radio" class="form-check-input"
											name="data-layout-position" id="layout-position-fixed" value="fixed">
										<label class="form-check-label"
											for="layout-position-fixed">Fixed</label>
									</div>
								</div>
								<div class="col-6">
									<div class="form-check">
										<input type="radio" class="form-check-input"
											name="data-layout-position" id="layout-position-scrollable"
											value="scrollable">
										<label class="form-check-label"
											for="layout-position-scrollable">Scrollable</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		@include('sweetalert::alert')


		<!-- Vendor js -->
		<script src="{{asset('assets/js/vendor.min.js')}}"></script>

		<script src="{{asset('assets/vendor/lucide/umd/lucide.min.js')}}"></script>

		<!-- Apex Charts js -->
		<script src="{{asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>

		<!-- Vector Map js -->
		<script
			src="{{asset('assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
		<script
			src="{{asset('assets/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js')}}"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                var translations = {
                    Error: '{{ __("translation.Error") }}',
                    An_unexpected_error_occurred: '{{ __("translation.An_unexpected_error_occurred") }}',
                    Success: '{{ __("translation.Success") }}',
                    Item_quantity_increased: '{{ __("translation.Item_quantity_increased") }}',
                    Item_quantity_decreased: '{{ __("translation.Item_quantity_decreased") }}',
                    Quantity_requested_exceeds_available_stock: '{{ __("translation.Quantity_requested_exceeds_available_stock") }}',
                    You_can_only_order: '{{ __("translation.You_can_only_order") }}',
                    Item_added_to_cart_successfully: '{{ __("translation.Item_added_to_cart_successfully") }}',
                };
            </script>

		<!-- Dashboard App js -->
		<script src="{{asset('assets/js/pages/dashboard.js')}}"></script>
		<script src="{{ asset('assets/js/sharedscript.js') }}"></script>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

		<!-- App js -->
		<script src="{{asset('assets/js/app.min.js')}}"></script>

	</body>

</html>
