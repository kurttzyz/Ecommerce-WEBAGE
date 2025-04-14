<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>@yield('title_seller')</title>
		<!-- Other meta tags and stylesheets -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	
	
	@vite('resources/css/app.css')
	@vite('resources/js/app.js')
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- Bootstrap 5 -->
	<link href="{{ asset('admin_asset/css/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	@livewireStyles
	
	<script src="https://unpkg.com/feather-icons"></script>
</head>	

<style>
	/* Fade-in Animation */
	@keyframes fadeIn {
		0% {
			opacity: 0;
		}
		100% {
			opacity: 1;
		}
	}

	/* Apply the fade-in animation */
	.fade-in {
		animation: fadeIn 1s ease-out;
	}


	/* Sidebar styling */
	.sidebar .sidebar-link {
		display: flex;
		align-items: center;
	}
	.sidebar .sidebar-link i {
		margin-right: 8px;
	}

	/* Navbar Styling */
	.navbar-nav {
		display: flex;
		gap: 1.5rem;
	}

	/* Toggle sidebar on small screens */
	@media (max-width: 991px) {
		#sidebar {
			display: none;
		}
		.sidebar-toggle {
			display: block;
		}

		.sidebar.show {
			display: block;
			position: absolute;
			left: 0;
			top: 0;
			width: 250px;
			height: 100%;
			background-color: #222;
		}

		.navbar-nav {
			display: none;
		}

		.navbar-nav.mobile {
			display: flex;
			flex-direction: column;
			gap: 1rem;
		}
	}

	/* Make sidebar links and navbar items look better on smaller screens */
	@media (max-width: 767px) {
		.sidebar-link {
			font-size: 14px;
		}
		.nav-link {
			font-size: 14px;
		}
	}
</style>

<body class="bg-black text-white font-sans antialiased">
	<div class="wrapper">
		<!-- Sidebar -->
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="{{ route('seller.dashboard') }}">
					<span class="align-middle">WebAge</span>
				</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">Main</li>
					<li class="sidebar-item {{ request()->routeIs('seller.dashboard') ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ route('seller.dashboard') }}">
							<i class="align-middle" data-feather="sliders"></i>
							<span class="align-middle">Dashboard</span>
						</a>
					</li>
					<li class="sidebar-item {{ request()->routeIs('seller.payments') ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ route('seller.payments') }}">
							<i class="align-middle" data-feather="credit-card"></i>
							<span class="align-middle">Revenue</span>
						</a>
					</li>

					<li class="sidebar-item {{request()->routeIs('seller.orders.order')?'active':''}}">
						<a class="sidebar-link" href="{{route('seller.orders.order')}}">
							<i class="align-middle" data-feather="clock"></i> 
							<span class="align-middle">Pending Orders</span>

							@auth
								@php
									$pending_order = Auth::user()->orders()->where('shipment_status', 'pending')->count();
								@endphp
								@if($pending_order > 0)
									<span class="absolute top-0 right-1/4 -mt-1 bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
										{{ $pending_order }}
									</span>
								@endif
							@endauth
							
						</a>
					</li>

					<li class="sidebar-item {{request()->routeIs('seller.orders.pending')?'active':''}}">
						<a class="sidebar-link" href="{{route('seller.orders.pending')}}">
							<i class="align-middle" data-feather="clock"></i> <span class="align-middle">Order History</span>
							
						</a>
					</li>

				

					<li class="sidebar-header">
						Store
					</li>


					<li class="sidebar-item {{request()->routeIs('seller.store.create')?'active':''}}">
						<a class="sidebar-link" href="{{route('seller.store.create')}}">
              				<i class="align-middle" data-feather="plus"></i> <span class="align-middle">Create Store</span>
            			</a>
					</li>

					<li class="sidebar-item {{request()->routeIs('seller.store.manage')?'active':''}}">
						<a class="sidebar-link" href="{{route('seller.store.manage')}}">
              				<i class="align-middle" data-feather="list"></i> <span class="align-middle">Manage Store</span>
            			</a>
					</li>

					<li class="sidebar-header">
						Products
					</li>


					<li class="sidebar-item {{request()->routeIs('seller.product')?'active':''}}">
						<a class="sidebar-link" href="{{route('seller.product')}}">
							<i class="align-middle" data-feather="plus"></i> <span class="align-middle">Create Product</span>
						</a> 
					</li>

					<li class="sidebar-item {{request()->routeIs('seller.product.manage')?'active':''}}">
						<a class="sidebar-link" href="{{route('seller.product.manage')}}">
              				<i class="align-middle" data-feather="list"></i> <span class="align-middle">Manage Product</span>
            			</a>
					</li>

			

					
				</ul>	
			</div>
		</nav>

		<div class="main">
			<!-- Navbar -->
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<!-- Sidebar Toggle -->
				<a class="sidebar-toggle js-sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a>
				<div class="container">
					<!-- Navigation Bar -->
					<div class="container mx-auto px-6 flex justify-between items-center">
						<!-- Logo -->
						<a href="{{route('seller.dashboard')}}" class="text-2xl font-bold text-black hover:text-red-300 transition duration-300">WebAge</a>
					
						<!-- Product Search Component (Responsive) -->
						<div class="text-black hidden md:flex items-center space-x-6">
							<i class="me-2" data-feather="search"></i>
							@livewire('seller-search-product')
						</div>
					
						<!-- Navbar Links -->
						<div class="flex items-center space-x-8 text-lg">
							<a href="{{route('seller.dashboard')}}" class="text-black flex items-center hover:text-red-500 no-underline">
								<i class="align-middle me-2 hover:text-red-500" data-feather="home"></i> Home
							</a>
							
							<a href="{{ route('seller.store.view') }}" 
								class="text-black hover:text-red-500 transition duration-300 flex items-center">
								 <i class="align-middle me-2 hover:text-red-500" data-feather="shopping-cart"></i> Shop
							 </a>


						
	
							<!-- Filter Component (Responsive) -->
							<div class="text-black hidden lg:flex items-center">
								<i class="align-middle me-2 hover:text-red-500" data-feather="filter"></i>
								@livewire('seller-filter-product')
							</div>
					
							<a href="{{ route('seller.cart.index') }}" class="relative inline-block">
								<i class="fas fa-shopping-cart text-2xl text-gray-800"></i>
							
								@auth
									@php
										$cartCount = Auth::user()->cartItems()->count();
									@endphp
									@if($cartCount > 0)
										<span class="absolute top-0 right-0 -mt-1 -mr-2 bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
											{{ $cartCount }}
										</span>
									@endif
								@endauth
							</a>

						</div>
					
						
						
					</div>

					<!-- Right side navbar items (User Profile) -->
					<ul class="navbar-nav ms-auto mobile">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="me-2" data-feather="user" class="align-middle"></i>
								<span>{{ Auth::user()->name }}</span>
							</a>
							<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
								<li>
									<a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
										<i class="align-middle me-2" data-feather="user"></i>
										<span>Profile</span>
									</a>
								</li>
								<li>
									<a class="dropdown-item d-flex align-items-center" href="#">
										<i class="align-middle me-2" data-feather="settings"></i>
										<span>Settings</span>
									</a>
								</li>
								<li><hr class="dropdown-divider"></li>
								<li>
									<form method="POST" action="{{ route('logout') }}">
										@csrf
										<button type="submit" class="dropdown-item d-flex align-items-center">
											<i class="align-middle me-2" data-feather="log-out"></i>
											<span>Log Out</span>
										</button>
									</form>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>

			<!-- Main Content -->
			<main class="content py-4 bg-black">
				@yield('seller_layout')
			</main>

			<!-- Footer -->
			<footer class="bg-black footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="#" target="_blank"><strong>WebAge</strong></a> &copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item"><a class="text-muted" href="#">Support</a></li>
								<li class="list-inline-item"><a class="text-muted" href="#">Privacy</a></li>
								<li class="list-inline-item"><a class="text-muted" href="#">Terms</a></li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="{{ asset('admin_asset/js/app.js') }}"></script>
	@livewireScripts

	<script>
		// Toggle Sidebar for Mobile
		document.addEventListener("DOMContentLoaded", function () {
			const sidebar = document.querySelector("#sidebar");
			const sidebarToggler = document.querySelector(".navbar-toggler");

			if (sidebarToggler && sidebar) {
				sidebarToggler.addEventListener("click", function () {
					sidebar.classList.toggle("show");
				});
			}
		});
	</script>



</body>
</html>
