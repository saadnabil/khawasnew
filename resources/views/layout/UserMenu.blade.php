	<div class="leftside-menu">

				<!-- Logo Light -->
				<a href="index.html" class="logo logo-light">
					<span class="logo-lg">
						<img src="{{asset('assets/images/tree logo.png')}}" alt="logo"
							style="vertical-align: middle;">
						<h4
							style="color: white; display: inline-block; margin-left: 5px;">Elkhawas
							Trade</h4>
					</span>

					<span class="logo-sm">
						<img src="{{asset('assets/images/tree logo.png')}}" alt="small logo">
					</span>
				</a>

				<!-- Logo Dark -->
				<a href="index.html" class="logo logo-dark">
					<span class="logo-lg">
						<img src="{{asset('assets/images/tree logo.png')}}" alt="logo"
							style="vertical-align: middle;">
						<h4
							style="color: black; display: inline-block; margin-left: 5px;">Elkhawas
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
							<a href="{{route('user.products.index')}}" class="side-nav-link">
								<i class="ri-dashboard-2-line"></i>
								<span> Products </span>
								<!-- <span class="badge bg-success float-end">9+</span> -->
							</a>
						</li>

						

						<li class="side-nav-title">Orders</li>

						<li class="side-nav-item">
							<a data-bs-toggle="collapse" href="#order" aria-expanded="false"
								aria-controls="order" class="side-nav-link">
								<i class="ri-shopping-basket-line"></i>
								<span> Orders </span>
								<span class="menu-arrow"></span>

							</a>
							<div class="collapse" id="order">
								<ul class="side-nav-second-level">
									<li class="side-nav-item">
										<a class="side-nav-link" href="{{route('user.orders.index')}}">Orders List</a>
									</li>

									<li class="side-nav-item">
										<a class="side-nav-link" href="{{route('user.wishlist.index')}}">WishList</a>
									</li>

									<li class="side-nav-item">
										<a class="side-nav-link" href="{{route('user.Coupons.index')}}">Coupons</a>
									</li>

								</ul>
							</div>
						</li>

						
						

						<li class="side-nav-title">Settings</li>

						<li class="side-nav-item">
							<a data-bs-toggle="collapse" href="#setting" aria-expanded="false"
								aria-controls="setting" class="side-nav-link">
								<i class="ri-settings-3-line"></i>
								<span> Settings </span>
								<span class="menu-arrow"></span>

							</a>
							<div class="collapse" id="setting">
								<ul class="side-nav-second-level">
									<li class="side-nav-item">
										<a class="side-nav-link" href="#">Change Password</a>
									</li>

									<li class="side-nav-item">
										<a class="side-nav-link" href="{{route('user.changeUserImage.index')}}">Change Profile Photo</a>
									</li>

								</ul>
							</div>
						</li>

						
						<li class="side-nav-item">
							<a href="{{route('user.contactUs.index')}}" class="side-nav-link">
								<i class="ri bi-chat-fill"></i>
								<span> Contact Us</span>

							</a>
						</li>
						

						<li class="side-nav-item">
							<a href="#" class="side-nav-link">
								<i class="ri-logout-box-line"></i>
								<span> Logout</span>

							</a>
						</li>

					</ul>
				</div>
			</div>