	<div class="leftside-menu">

	    <!-- Logo Light -->
	    <a href="{{route('user.items.index')}}" class="logo logo-light">
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
	            <li class="side-nav-title">{{__('translation.Main')}}</li>

	            <li class="side-nav-item">
	                <a href="{{route('user.items.index')}}" class="side-nav-link">
	                    <i class="ri-dashboard-2-line"></i>
	                    <span> {{__('translation.Items')}} </span>
	                    <!-- <span class="badge bg-success float-end">9+</span> -->
	                </a>
	            </li>



	            <li class="side-nav-title">{{__('translation.Orders')}}</li>

	            <li class="side-nav-item">
	                <a data-bs-toggle="collapse" href="#order" aria-expanded="false" aria-controls="order" class="side-nav-link">
	                    <i class="ri-shopping-basket-line"></i>
	                    <span> {{__('translation.Orders')}} </span>
	                    <span class="menu-arrow"></span>

	                </a>
	                <div class="collapse" id="order">
	                    <ul class="side-nav-second-level">
	                        <li class="side-nav-item">
	                            <a class="side-nav-link" href="{{route('user.orders.index')}}">{{__('translation.Orders List')}}</a>
	                        </li>

	                        <li class="side-nav-item">
	                            <a class="side-nav-link" href="{{route('wishlist.index')}}">{{__('translation.Wishlist')}}</a>
	                        </li>

	                        <li class="side-nav-item">
	                            <a class="side-nav-link" href="{{route('user.Coupons.index')}}">{{__('translation.Coupons')}}</a>
	                        </li>

	                    </ul>
	                </div>
	            </li>

 


	            <li class="side-nav-title">{{__('translation.Settings')}}</li>

	            <li class="side-nav-item">
	                <a data-bs-toggle="collapse" href="#setting" aria-expanded="false" aria-controls="setting" class="side-nav-link">
	                    <i class="ri-settings-3-line"></i>
	                    <span> {{__('translation.Settings')}} </span>
	                    <span class="menu-arrow"></span>

	                </a>
	                <div class="collapse" id="setting">
	                    <ul class="side-nav-second-level">
	                        <li class="side-nav-item">
	                            <a class="side-nav-link" href="{{route('user.UserShowPassword')}}">{{__('translation.Change password')}}</a>
	                        </li>

	                        <li class="side-nav-item">
	                            <a class="side-nav-link" href="{{route('user.changeUserImage.index')}}">{{__('translation.Change profile photo')}}</a>
	                        </li>

	                    </ul>
	                </div>
	            </li>


  <li class="side-nav-title">{{__('translation.Support')}}</li>

	            <li class="side-nav-item">
	                <a data-bs-toggle="collapse" href="#support" aria-expanded="false" aria-controls="support" class="side-nav-link">
	                    <i class="ri-chat-3-line"></i>

	                    <span>{{__('translation.Support')}} </span>
	                    <span class="menu-arrow"></span>

	                </a>
	                <div class="collapse" id="support">
	                    <ul class="side-nav-second-level">
	                        <li class="side-nav-item">
	                            <a class="side-nav-link" href="{{ route('user.support') }}">{{__('translation.Make a Ticket')}}</a>
	                        </li>

	                       

	                    </ul>
	                </div>
	            </li>

	              

					
	        

	           
			   


	            <li class="side-nav-item">
	                <a href="{{route('user.contactUs.index')}}" class="side-nav-link">
	                    <i class="ri bi-chat-fill"></i>
	                    <span> {{__('translation.Contact Us')}}</span>

	                </a>

					
	            </li>


	             <li class="side-nav-item">
                <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" class="side-nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="ri-logout-box-line"></i>
                    <span> {{__('translation.Logout')}}</span>
                </a>
            </li>

	        </ul>
	    </div>
	</div>
