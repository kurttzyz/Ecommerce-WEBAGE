<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	
	
	<title>@yield('title_admin')</title>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link href="{{asset('admin_asset/css/app.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
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
<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
		
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="{{route('admin')}}">
					<span class="align-middle">WebAge Admin</span>
				</a>
		

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Main
					</li>

					<li class="sidebar-item {{request()->routeIs('admin')?'active':''}}">
						<a class="sidebar-link" href="{{route('admin')}}">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
						</a>
					</li>

					<li class="sidebar-item {{request()->routeIs('admin.manage.user')?'active':''}}">
						<a class="sidebar-link" href="{{route('admin.manage.user')}}">
              				<i class="align-middle" data-feather="users"></i> <span class="align-middle">Manage Users</span>
           			 	</a>
					</li>

					<li class="sidebar-item {{request()->routeIs('admin.manage.revenues')?'active':''}}">
						<a class="sidebar-link" href="{{route('admin.manage.revenues')}}">
							<i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Site Revenues</span>
            			</a>
					</li>

					<li class="sidebar-header">
						Category
					</li>


					<li class="sidebar-item {{request()->routeIs('category.create')?'active':''}}">
						<a class="sidebar-link" href="{{route('category.create')}}">
              				<i class="align-middle" data-feather="plus"></i> <span class="align-middle">Create</span>
            			</a>
					</li>

					<li class="sidebar-item {{request()->routeIs('category.manage')?'active':''}}">
						<a class="sidebar-link" href="{{route('category.manage')}}">
              				<i class="align-middle" data-feather="list"></i> <span class="align-middle">Manage</span>
            			</a>
					</li>


					<li class="sidebar-header">
						Sub-Category
					</li>


					<li class="sidebar-item {{request()->routeIs('subcategory.create')?'active':''}}">
						<a class="sidebar-link" href="{{route('subcategory.create')}}">
              				<i class="align-middle" data-feather="plus"></i> <span class="align-middle">Create</span>
            			</a>
					</li>

					<li class="sidebar-item {{request()->routeIs('subcategory.manage')?'active':''}}">
						<a class="sidebar-link" href="{{route('subcategory.manage')}}">
              				<i class="align-middle" data-feather="list"></i> <span class="align-middle">Manage</span>
            			</a>
					</li>

					
					


					
					<li class="sidebar-header">
						Product
					</li>


					<li class="sidebar-item {{request()->routeIs('product.manage')?'active':''}}">
						<a class="sidebar-link" href="{{route('product.manage')}}">
              				<i class="align-middle" data-feather="box"></i> <span class="align-middle">Manage Product</span>
            			</a>
					</li>

					<li class="sidebar-item {{request()->routeIs('product.review.manage')?'active':''}}">
						<a class="sidebar-link" href="{{route('product.review.manage')}}">
              				<i class="align-middle" data-feather="star"></i> <span class="align-middle">Manage Review</span>
            			</a>
					</li>



					<li class="sidebar-header">
						History
					</li>


					<li class="sidebar-item {{request()->routeIs('admin.cart.history')?'active':''}}">
						<a class="sidebar-link" href="{{route('admin.cart.history')}}">
              				<i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Cart</span>
            			</a>
					</li>

					<li class="sidebar-item {{request()->routeIs('admin.settings')?'active':''}}">
						<a class="sidebar-link" href="{{route('admin.settings')}}">
              				<i class="align-middle" data-feather="user"></i> <span class="align-middle">Settings</span>
            			</a>
					</li>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          			<i class="hamburger align-self-center"></i>
        		</a>
			
				<div class="container">
				<div class="navbar-collapse collapse">
					
			  		<ul class="navbar-nav ms-auto">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" data-bs-toggle="dropdown">
								<i class="me-2" data-feather="user"></i>
								<span>{{ Auth::user()->name }}</span>
							</a>
								<ul class="dropdown-menu dropdown-menu-end">
									<li>
										<a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
											<i class="align-middle me-2" data-feather="user"></i> 
											{{ __('Profile') }}
										</a>
									</li>

									<li>
										<a class="dropdown-item d-flex align-items-center" href="#">
											<i class="align-middle me-2" data-feather="settings"></i> Settings
										</a>
									</li>

									<li class="dropdown-divider"></li>
									<li>
										<form method="POST" action="{{ route('logout') }}">
											@csrf
											<button class="dropdown-item d-flex align-items-center">
												<i class="align-middle me-2" data-feather="log-out"></i> Log Out
											</button>
										</form>
									</li>
									</ul>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
			
				@yield('admin_layout')

			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="#" target="_blank"><strong>WebAge</strong></a> - <a class="text-muted" href="#" target="_blank"></a>&copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="#" target="_blank">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#" target="_blank">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#" target="_blank">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#" target="_blank">Terms</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="{{asset('admin_asset/js/app.js')}}"src="js/app.js"></>

	<script>
		document.addEventListener("DOMContentLoaded", function () {
			const sidebar = document.getElementById("sidebar");
			const toggleBtn = document.getElementById("sidebarToggle");
	
			toggleBtn.addEventListener("click", function () {
				sidebar.classList.toggle("d-none");
			});
		});
	</script>
	
</body>

</html>