<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title_seller')</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	@vite('resources/css/app.css')
	@vite('resources/js/app.js')
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="icon" href="{{ asset('landingpage/img/notes.png') }}" type="image/gif" sizes="16x16">
	<!-- Bootstrap 5 -->
	<link href="{{ asset('admin_asset/css/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	@livewireStyles
	<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
	<script src="https://unpkg.com/feather-icons"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
				<p class="sidebar-brand">
					<center><span class="align-middle">Welcome, {{Auth::user()->full_name}}!</span></center>
				</p>

				<ul class="sidebar-nav">
					<li class="sidebar-header">Main</li>
					<li class="sidebar-item {{ request()->routeIs('seller.dashboard') ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ route('seller.dashboard') }}">
							<i class="align-middle" data-feather="sliders"></i>
							<span class="align-middle">Dashboard</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{route('messages.index')}}">
							<div class="relative inline-block">
								<i class="fa-solid fa-message align-middle text-lg"></i>
					
								@auth
									@php
										$pending_count = \App\Models\Message::where('receiver_id', auth()->id())->count();

									@endphp

									@if($pending_count > 0)
										<span
											class="absolute top-0 right-1/4 -mt-1 bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
											{{ $pending_count }}
										</span>
									@endif
								@endauth
							</div>
							<span class="align-middle">Send Messages</span>
					
						</a>
					</li>
				

					<li class="sidebar-header">
						Mentors
					</li>

					<li class="sidebar-item {{request()->routeIs('seller.store.create') ? 'active' : ''}}">
						<a class="sidebar-link" href="{{route('seller.store.create')}}">
							<i class="align-middle" data-feather="plus"></i> <span class="align-middle">Create Mentors</span>
						</a>
					</li>

					<li class="sidebar-item {{request()->routeIs('seller.store.manage') ? 'active' : ''}}">
						<a class="sidebar-link" href="{{route('seller.store.manage')}}">
							<i class="align-middle" data-feather="users"></i> <span class="align-middle">Manage Mentors</span>
						</a>
					</li>

					<li class="sidebar-header">
						Mentor Courses
					</li>


					<li class="sidebar-item {{ request()->routeIs('courses.create') ? 'active' : '' }}">
						<a class="sidebar-link" href="{{ route('courses.create') }}">
							<i class="align-middle" data-feather="plus" ></i>
							<span class="align-middle ml-1">Create Course</span>
						</a>
					</li>
					

					<li class="sidebar-item {{request()->routeIs('courses.index') ? 'active' : ''}}">
						<a class="sidebar-link" href="{{route('courses.index')}}">
							<i class="align-middle" data-feather="book"></i> <span class="align-middle">Manage Course</span>
						</a>
					</li>

					<li class="sidebar-item {{ request()->routeIs('submissions') ? 'active' : '' }}" style="position: relative;">
						<a class="sidebar-link" href="{{ route('submissions') }}">
							<i class="align-middle" data-feather="clipboard"></i> 
							<span class="align-middle">Student Works</span>
							@auth
								@php

									$submissionCount = App\Models\Submission::count();


								@endphp

								@if($submissionCount > 0)
									<span class="absolute top-0 right-1/4 -mt-1 bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
										{{ $submissionCount }}
									</span>
								@endif
							@endauth
						</a>
					</li>

					


					<li class="sidebar-item {{request()->routeIs('courses.show.archive') ? 'active' : ''}}">
						<a class="sidebar-link" href="{{route('courses.show.archive')}}">
							<i class="align-middle" data-feather="archive"></i> <span class="align-middle">Archived Courses</span>
						</a>
					</li>

					<li class="sidebar-header">
						Featured Courses
					</li>


					<li class="sidebar-item {{request()->routeIs('seller.product') ? 'active' : ''}}">
						<a class="sidebar-link" href="{{route('seller.product')}}">
							<i class="align-middle" data-feather="plus"></i> <span class="align-middle">Create Courses</span>
						</a> 
					</li>

					<li class="sidebar-item {{request()->routeIs('seller.product.manage') ? 'active' : ''}}">
						<a class="sidebar-link" href="{{route('seller.product.manage')}}">
              				<i class="align-middle" data-feather="book"></i> <span class="align-middle">Manage Courses</span>
            			</a>
					</li>


				



					<li class="sidebar-header">
						Certificates & Achievements
					</li>


					<li class="sidebar-item {{request()->routeIs('certificates.create') ? 'active' : ''}}">
						<a class="sidebar-link" href="{{route('certificates.create')}}">
							<i class="align-middle" data-feather="plus"></i> <span class="align-middle">Issue Certificates</span>
						</a>
					</li>

					<li class="sidebar-item {{request()->routeIs('certificates.index') ? 'active' : ''}}">
						<a class="sidebar-link" href="{{route('certificates.index')}}">
							<i class="align-middle" data-feather="award"></i> <span class="align-middle">Manage Certificates</span>
						</a>
					</li>

					<li class="sidebar-item {{request()->routeIs('achievements.create') ? 'active' : ''}}">
						<a class="sidebar-link" href="{{ route('achievements.create') }}">
							<i class="align-middle" data-feather="plus"></i> <span class="align-middle">Create Achievements</span>
						</a>
					</li>

					<li class="sidebar-item {{request()->routeIs('mentor.assign.index') ? 'active' : ''}}">
						<a class="sidebar-link" href="{{ route('mentor.assign.index') }}">
							<i class="align-middle" data-feather="award"></i> <span class="align-middle">Manage Achievements</span>
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
					<img src="{{ asset('landingpage/img/notes.png') }}" alt="Logo" class="w-14 h-12">
					<p class="text-2xl font-bold text-black hover:text-red-300 transition duration-300">ConnectingNotes</p>
					<div class="container mx-auto px-6 flex justify-between items-center">	

						<!-- Product Search Component (Responsive) -->
						<div class="text-black hidden md:flex items-center space-x-8">
							<i class="me-2" ></i>
							@livewire('seller-search-product')
						</div>
					
						<!-- Navbar Links -->
						<div class="flex items-center space-x-8 text-lg">
						
							
							<a id="shop-link" href="{{ route('seller.store.view') }}" 
								class="text-black hover:text-red-500 transition duration-300 flex items-center">
								<i data-feather="users" class="hover:text-red-500"></i> Mentors
							 </a>

							<!-- Filter Component (Responsive) -->
							<div class="text-black hidden lg:flex items-center">
								<i class="align-middle hover:text-red-500 " data-feather="filter"></i>
								@livewire('seller-filter-product')
							</div>
					
							<!-- Notification Bell with Dropdown -->
							<div x-data="{ open: false }" class="relative">
								<!-- Bell Button -->
								<button @click="open = !open" class="relative focus:outline-none">
									<!-- Bell Icon -->
									<svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
										stroke-linecap="round" stroke-linejoin="round">
										<path d="M15 17h5l-1.405-1.405C18.79 14.79 18 13.42 18 12V8a6 6 0 10-12 0v4
							                     c0 1.42-.79 2.79-1.595 3.595L3 17h5m4 0v1a3 3 0 11-6 0v-1m6 0H9" />
									</svg>
							
									<!-- Red Dot for Unread Notifications -->
									@if(auth()->user()->unreadNotifications->count())
										<span class="absolute top-0 right-0 inline-flex items-center justify-center w-3 h-3 
														 bg-red-500 rounded-full"></span>
									@endif
								</button>
							
								<!-- Dropdown -->
								<div x-show="open" @click.away="open = false" x-transition
									class="absolute right-0 mt-2 w-72 bg-white border border-gray-200 rounded shadow-lg z-50">
							
									@if(auth()->user()->notifications->count())
										@foreach (auth()->user()->notifications as $notification)
											<div class="px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 flex items-start gap-2">
												@if(is_null($notification->read_at))
													<span class="w-2 h-2 bg-red-500 rounded-full mt-1"></span>
												@endif
												<span>{{ $notification->data['message'] }}</span>
											</div>
										@endforeach
									@else
										<div class="px-4 py-2 text-sm text-gray-500">
											No new notifications
										</div>
									@endif
								</div>
							</div>



						

						</div>
					
						
						
					</div>

					<!-- Right side navbar items (User Profile) -->
					<ul class="navbar-nav ms-auto mobile">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
								<div id="profileIconWrapper"
									class="w-12 h-12 rounded-full overflow-hidden flex items-center justify-center bg-gray-200">
									@if (Auth::user()->profile_photo)
										<img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile Photo"
											class="w-full h-full object-cover">
									@else
										<i id="profileIcon" class="fa fa-user text-gray-500 text-4xl"></i>
									@endif
								</div>
								<span>{{ Auth::user()->full_name }}</span>
							</a>
							<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
								
								<form id="profileForm" enctype="multipart/form-data"
									class="flex flex-col items-center gap-4 p-4 bg-white shadow-md rounded-md w-fit mx-auto">
									@csrf
								
									<div id="profileIconWrapper"
										class="w-12 h-12 rounded-full overflow-hidden flex items-center justify-center bg-gray-200">
										@if (Auth::user()->profile_photo)
											<img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile Photo"
												class="w-full h-full object-cover">
										@else
											<i id="profileIcon" class="fa fa-user text-gray-500 text-4xl"></i>
										@endif
									</div>
								
								
									<!-- File Input -->
									<label for="profile_photo" style="color:black">
										Choose Profile Photo
										<input type="file" name="profile_photo" id="profile_photo" accept="image/*" class="hidden">
									</label>
								
									<!-- Submit Button -->
									<button type="submit" class="px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">
										Upload
									</button>
								</form>

								<li><hr class="dropdown-divider"></li>
								<li>

									<a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
										<i class="align-middle me-2" data-feather="user"></i>
										<span>Profile</span>
									</a>

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
			<main class="content py-4">
				<div id="content-container">
					@yield('seller_layout')
					@yield('seller_home')
					@yield('seller_shop')
					@yield('seller_cart')
				</div>
			</main>

			<!-- Footer -->
			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="#" target="_blank"><strong>ConnectingNotes</strong></a> &copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item"><a class="text-muted text-white" href="#">Support</a></li>
								<li class="list-inline-item"><a class="text-muted text-white" href="#">Support</a></li>
								<li class="list-inline-item"><a class="text-muted text-white" href="#">Privacy</a></li>
								<li class="list-inline-item"><a class="text-muted text-white" href="#">Terms</a></li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="{{ asset('admin_asset/js/app.js') }}"></script>
	@livewireScripts

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="//unpkg.com/alpinejs" defer></script>

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


<script>
	document.addEventListener("DOMContentLoaded", function () {
		const sidebarToggle = document.querySelector('.js-sidebar-toggle');
		const sidebar = document.getElementById('sidebar');

		if (sidebarToggle && sidebar) {
			sidebarToggle.addEventListener('click', () => {
				sidebar.classList.toggle('show');
			});
		}
	});
</script>
<script>
	document.addEventListener("DOMContentLoaded", function () {
		feather.replace();
	});



	document.addEventListener("livewire:load", () => {
		feather.replace();
	});

</script>

<script>
	$('#shop-link').on('click', function(event) {
		console.log("Shop link clicked!");
		event.preventDefault();
		const url = '{{ route('seller.store.view') }}';
		$.ajax({
			url: url,
			method: 'GET',
			success: function(response) {
				var content = $(response).find('#content-container').html();
				$('#content-container').html(content);
				history.pushState(null, '', url); 
			}
		});
	});
	
	$('#cart-link').on('click', function(event) {
		console.log("Cart link clicked!");
		event.preventDefault();
		const url = '{{ route('seller.cart.index') }}';
		$.ajax({
			url: url,
			method: 'GET',
			success: function(response) {
				var content = $(response).find('#content-container').html();
				$('#content-container').html(content);
				history.pushState(null, '', url); 
			}
		});
	});
	
	$('#homepage-link').on('click', function(event) {
		console.log("Homepage link clicked!");
		event.preventDefault();
		const url = '{{ route('seller.dashboard') }}';
		$.ajax({
			url: url,
			method: 'GET',
			success: function(response) {
				var content = $(response).find('#content-container').html();
				$('#content-container').html(content);
				history.pushState(null, '', url); 
			}
		});
	});


	$(document).on('submit', '.cart-increase-form, .cart-decrease-form', function(event) {
        event.preventDefault();
    
        const form = $(this);
        const url = form.attr('action');
        const method = form.find('input[name="_method"]').val() || 'POST';
        const formData = form.serialize();
    
        $.ajax({
            url: url,
            method: method,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Refresh just the cart section
                $('#content-container').load(location.href + " #content-container > *");
            },
            error: function(xhr) {
                console.error("Error:", xhr.responseText);
            }
        });
    });
</script>



<script>
	document.getElementById('profileForm').addEventListener('submit', async function (e) {
		e.preventDefault();

		const formData = new FormData();
		const fileField = document.querySelector('#profile_photo');

		formData.append('profile_photo', fileField.files[0]);

		const response = await fetch("{{ route('profile.seller.upload') }}", {
			method: 'POST',
			headers: {
				'X-CSRF-TOKEN': '{{ csrf_token() }}',
			},
			body: formData,
		});

		const result = await response.json();

		if (response.ok) {
			alert('Image uploaded successfully!');
			// Update the image preview with the uploaded image URL
			document.querySelector('#profileIconWrapper').innerHTML =
				`<img src="${result.image_url}" alt="Profile Photo" class="w-full h-full object-cover">`;
		} else {
			alert(result.message || 'Upload failed.');
		}
	});
</script>


<script>
	document.getElementById('profile_photo').addEventListener('change', function (e) {
		const file = e.target.files[0];
		const wrapper = document.getElementById('profileIconWrapper');

		if (file && file.type.startsWith('image/')) {
			const reader = new FileReader();
			reader.onload = function (event) {
				wrapper.innerHTML = `<img src="${event.target.result}" alt="Profile Picture" class="w-full h-full object-cover">`;
			};
			reader.readAsDataURL(file);
		} else {
			wrapper.innerHTML = `<i id="profileIcon" class="fa fa-user text-gray-500 text-4xl"></i>`;
		}
	});
</script>
</body>
</html>
