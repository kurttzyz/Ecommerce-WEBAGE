<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	
	@vite('resources/css/app.css')
	@vite('resources/js/app.js')
	
	<title>@yield('title_admin')</title>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link href="{{asset('admin_asset/css/app.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<script src="https://unpkg.com/feather-icons"></script>

	<link href="{{ asset('admin_asset/css/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="icon" href="{{ asset('landingpage/img/notes.png') }}" type="image/gif" sizes="16x16">
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
					<center><span class="align-middle">Welcome, {{Auth::user()->full_name}} Admin!</span></center>
				</a>

				<ul class="sidebar-nav">

				<li class="sidebar-header">
					Personal
				</li>
				
				<li class="sidebar-item nav-item dropdown">
					<a class="nav-link dropdown-toggle d-flex align-items-center sidebar-link" href="#" id="profileDropdown"
						data-bs-toggle="dropdown">
						<div id="profileIconWrapper"
							class="w-12 h-12 rounded-full overflow-hidden flex items-center justify-center bg-gray-200">
							@if (Auth::user()->profile_photo)
								<img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile Photo"
									class="w-full h-full object-cover">
							@else
								<i id="profileIcon" class="fa fa-user text-gray-500 text-4xl"></i>
							@endif
						</div>
						<center><span>{{ Auth::user()->full_name }}</span></center>
					</a>
					<ul class="dropdown-menu dropdown-menu-end">
				
				
						<!-- Profile Photo Upload Form -->
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
				
				
						<li>
							<a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
								<i class="align-middle me-2" data-feather="user"></i>
								{{ __('Profile') }}
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
			
				
		

				
					<li class="sidebar-header">
						Main
					</li>

					<li class="sidebar-item {{request()->routeIs('admin') ? 'active' : ''}}">
						<a class="sidebar-link" href="{{route('admin')}}">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
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
									<span class="absolute top-0 right-1/4 -mt-1 bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
										{{ $pending_count }}
									</span>
								@endif
							@endauth
						</div>
							<span class="align-middle">Send Messages</span>
						
						</a>
					</li>


					<li class="sidebar-item relative">
						<a class="sidebar-link" href="{{ route('community.index') }}">
							<div class="relative inline-block">
								<i class="fa-solid fa-message align-middle text-lg"></i>
								@auth
									@php
	$pending_form = \App\Models\Message::count(); // Count all messages
									@endphp

									@if($pending_form > 0)
										<span class="absolute top-0 right-1/4 -mt-1 bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
											{{ $pending_form }}
										</span>
									@endif
								@endauth
							</div>
							<span class="align-middle">All Messages</span>
						</a>
					</li>
					



					<li class="sidebar-item {{request()->routeIs('admin.manage.user') ? 'active' : ''}}">
						<a class="sidebar-link" href="{{route('admin.manage.user')}}">
							<i class="align-middle" data-feather="users"></i> <span class="align-middle">Manage Users</span>
						</a>
					</li>

					<li class="sidebar-item {{request()->routeIs('product.manage') ? 'active' : ''}}">
						<a class="sidebar-link" href="{{route('product.manage')}}">
							<i class="align-middle" data-feather="box"></i> <span class="align-middle">Manage Sessions</span>
						</a>
					</li>

					<li class="sidebar-item {{request()->routeIs('admin.application_form') ? 'active' : ''}}">
						<a class="sidebar-link" href="{{route('admin.application_form')}}">
							<i class="align-middle" data-feather="users"></i> <span class="align-middle">Mentor Application</span>
					
							@auth
								@php
	$pending_forms = \App\Models\SellerForm::where('status', 'pending')->count();
								@endphp

								@if($pending_forms > 0)
									<span class="absolute top-0 right-1/4 -mt-1 bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
										{{ $pending_forms }}
									</span>
								@endif
							@endauth
					
					
						</a>
					</li>


					<li class="sidebar-item {{request()->routeIs('forms.archived') ? 'active' : ''}}">
						<a class="sidebar-link" href="{{route('forms.archived')}}">
							<i class="align-middle" data-feather="archive"></i> <span class="align-middle">Archived Applications</span>
						</a>
					</li>


					<li class="sidebar-header">
						Category
					</li>


					<li class="sidebar-item {{request()->routeIs('category.create') ? 'active' : ''}}">
						<a class="sidebar-link" href="{{route('category.create')}}">
              				<i class="align-middle" data-feather="plus"></i> <span class="align-middle">Create</span>
            			</a>
					</li>

					<li class="sidebar-item {{request()->routeIs('category.manage') ? 'active' : ''}}">
						<a class="sidebar-link" href="{{route('category.manage')}}">
              				<i class="align-middle" data-feather="list"></i> <span class="align-middle">Manage</span>
            			</a>
					</li>


					<li class="sidebar-header">
						Sub-Category
					</li>


					<li class="sidebar-item {{request()->routeIs('subcategory.create') ? 'active' : ''}}">
						<a class="sidebar-link" href="{{route('subcategory.create')}}">
              				<i class="align-middle" data-feather="plus"></i> <span class="align-middle">Create</span>
            			</a>
					</li>

					<li class="sidebar-item {{request()->routeIs('subcategory.manage') ? 'active' : ''}}">
						<a class="sidebar-link" href="{{route('subcategory.manage')}}">
              				<i class="align-middle" data-feather="list"></i> <span class="align-middle">Manage</span>
            			</a>
					</li>
					
					<li class="sidebar-header">
						Reports
					</li>


					<li class="sidebar-item {{request()->routeIs('admin.manage.revenues') ? 'active' : ''}}">
						<a class="sidebar-link" href="{{route('admin.manage.revenues')}}">
							<i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Site Revenues</span>
						</a>
					</li>


					

					

					<li class="sidebar-item {{request()->routeIs('product.review.manage') ? 'active' : ''}}">
						<a class="sidebar-link" href="{{route('product.review.manage')}}">
              				<i class="align-middle" data-feather="award"></i> <span class="align-middle">Manage Achievements</span>
            			</a>
					</li>


					<li class="sidebar-item {{request()->routeIs('manage.certificates') ? 'active' : ''}}">
						<a class="sidebar-link" href="{{route('manage.certificates')}}">
							<i class="align-middle" data-feather="award"></i> <span class="align-middle">Manage Certificates</span>
						</a>
					</li>		
		</nav>

		<div class="main">

			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<!-- Sidebar Toggle -->
				<a class="sidebar-toggle js-sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a>
				
			</nav>
			

			<main class="content">
			
				@yield('admin_layout')

			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="#" target="_blank"><strong>ConnectingNotes</strong></a> - <a class="text-muted" href="#" target="_blank"></a>&copy;
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



	<script>
		document.addEventListener("DOMContentLoaded", function () {
			const sidebar = document.getElementById("sidebar");
			const toggleBtn = document.getElementById("sidebarToggle");
	
			toggleBtn.addEventListener("click", function () {
				sidebar.classList.toggle("d-none");
			});
		});
	</script>


	<script src="{{ asset('admin_asset/js/app.js') }}"></script>


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
	document.getElementById('profileForm').addEventListener('submit', async function (e) {
		e.preventDefault();

		const formData = new FormData();
		const fileField = document.querySelector('#profile_photo');

		formData.append('profile_photo', fileField.files[0]);

		const response = await fetch("{{ route('profile.admin.upload') }}", {
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