<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

	<title><?php echo $__env->yieldContent('title_customer'); ?></title>
		<!-- Other meta tags and stylesheets -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
	<?php echo app('Illuminate\Foundation\Vite')('resources/js/app.js'); ?>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- Bootstrap 5 -->
	<link href="<?php echo e(asset('admin_asset/css/app.css')); ?>" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

	<script src="https://unpkg.com/feather-icons"></script>
	<link rel="icon" href="<?php echo e(asset('landingpage/img/notes.png')); ?>" type="image/gif" sizes="16x16">
	

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
				<p class="sidebar-brand" >
					<center><span class="align-middle">Welcome. <?php echo e(Auth::user()->full_name); ?>!</span></center>
				</p>

				<ul class="sidebar-nav">
					<li class="sidebar-header"	>Main</li>
					<li class="sidebar-item <?php echo e(request()->routeIs('customer.dashboard') ? 'active' : ''); ?>">
						<a class="sidebar-link" href="<?php echo e(route('customer.dashboard')); ?>">
							<i class="align-middle" data-feather="sliders"></i>
							<span class="align-middle">Dashboard</span>
						</a>
					</li>

					<li class="sidebar-item <?php echo e(request()->routeIs('customer.class') ? 'active' : ''); ?>">
						<a class="sidebar-link relative" href="<?php echo e(route('customer.class')); ?>">
							<i class="align-middle" data-feather="sliders"></i>
							<span class="align-middle">Classes</span>
					
					
					
							<?php if(auth()->guard()->check()): ?>
								<?php
	$total_classes = Auth::user()->enrolled_courses->count(); // Note the underscore
								?>

								<?php if($total_classes > 0): ?>

									<span class="absolute top-0 right-1/4 -mt-1 bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
										<?php echo e($total_classes); ?>

									</span>
								<?php endif; ?>
							<?php endif; ?>
						</a>
					</li>


					

					<li class="sidebar-item <?php echo e(request()->routeIs('certificates') ? 'active' : ''); ?>">
					<a class="sidebar-link" href="<?php echo e(route('certificates')); ?>">
						<i class="align-middle" data-feather="sliders"></i>
						<span class="align-middle">Claim Certificates</span>

						<?php if(auth()->guard()->check()): ?>
							<?php
	$total_classes = Auth::user()->certificates()->count(); // Note the underscore
							?>

							<?php if($total_classes > 0): ?>

								<span class="absolute top-0 right-1/4 -mt-1 bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
									<?php echo e($total_classes); ?>

								</span>
							<?php endif; ?>
						<?php endif; ?>
					</a>
				</li>



				<li class="sidebar-item <?php echo e(request()->routeIs('achievements') ? 'active' : ''); ?>">
					<a class="sidebar-link" href="<?php echo e(route('achievements')); ?>">
						<i class="align-middle" data-feather="sliders"></i>
						<span class="align-middle">Manage Achievements</span>

						<?php if(auth()->guard()->check()): ?>
							<?php
	$total_classes = Auth::user()->achievements()->count(); // Note the underscore
							?>

							<?php if($total_classes > 0): ?>

								<span class="absolute top-0 right-1/4 -mt-1 bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
									<?php echo e($total_classes); ?>

								</span>
							<?php endif; ?>
						<?php endif; ?>
					</a>
				</li>

				<li class="sidebar-item">
					<a class="sidebar-link" href="<?php echo e(route('messages.index')); ?>">
						<div class="relative inline-block">
							<i class="fa-solid fa-message align-middle text-lg"></i>
				
							<?php if(auth()->guard()->check()): ?>
								<?php
									$pending_count = \App\Models\Message::where('receiver_id', auth()->id())->count();

								?>

								<?php if($pending_count > 0): ?>
									<span
										class="absolute top-0 right-1/4 -mt-1 bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
										<?php echo e($pending_count); ?>

									</span>
								<?php endif; ?>
							<?php endif; ?>
						</div>
						<span class="align-middle">Send Messages</span>
				
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
						<!-- Navigation Bar -->
						<img src="<?php echo e(asset('landingpage/img/notes.png')); ?>" alt="Logo" class="w-14 h-12">
						<p class="text-2xl font-bold text-black hover:text-red-300 transition duration-300 me-4">ConnectingNotes</p>
		

					
						<!-- Product Search Component (Responsive) -->
						<div class="text-black hidden md:flex items-center space-y-4">
							<?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('product-search-component');

$__html = app('livewire')->mount($__name, $__params, 'lw-3453409190-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
						</div>
					
						<!-- Navbar Links -->
						<div class="flex items-center space-x-8 text-lg">
							<a id="homepage-link" href="<?php echo e(route('customer.dashboard')); ?>" class="text-black flex items-center hover:text-red-500 no-underline">
								<i class="align-middle hover:text-red-500" data-feather="home"></i> Home
							</a>
							
							<a id="shop-link" href="<?php echo e(route('customer.store.view')); ?>" 
								class="text-black hover:text-red-500 transition duration-300 flex items-center">
								<i data-feather="users" class="hover:text-red-500"></i> Mentors
							 </a>

	
							<!-- Filter Component (Responsive) -->
							<div class="text-black hidden lg:flex items-center">
								<i class="align-middle hover:text-red-500" data-feather="filter"></i>
								<?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('filter-component');

$__html = app('livewire')->mount($__name, $__params, 'lw-3453409190-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
							</div>
					
					

						</div>
					
						
						
					</div>

					<!-- Right side navbar items (User Profile) -->
					<ul class="navbar-nav ms-auto mobile">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
								<div id="profileIconWrapper"
									class="w-12 h-12 rounded-full overflow-hidden flex items-center justify-center bg-gray-200">
									<?php if(Auth::user()->profile_photo): ?>
										<img src="<?php echo e(asset('storage/' . Auth::user()->profile_photo)); ?>" alt="Profile Photo"
											class="w-full h-full object-cover">
									<?php else: ?>
										<i id="profileIcon" class="fa fa-user text-gray-500 text-4xl"></i>
									<?php endif; ?>
								</div>

								<span><?php echo e(Auth::user()->full_name); ?></span>
							</a>
							<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
								<li>
								

								
									

								</li>
							<!-- Profile Photo Upload Form -->
							<form id="profileForm" enctype="multipart/form-data"
								class="flex flex-col items-center gap-4 p-4 bg-white shadow-md rounded-md w-fit mx-auto">
								<?php echo csrf_field(); ?>

								<div id="profileIconWrapper"
									class="w-12 h-12 rounded-full overflow-hidden flex items-center justify-center bg-gray-200">
									<?php if(Auth::user()->profile_photo): ?>
										<img src="<?php echo e(asset('storage/' . Auth::user()->profile_photo)); ?>" alt="Profile Photo"
											class="w-full h-full object-cover">
									<?php else: ?>
										<i id="profileIcon" class="fa fa-user text-gray-500 text-4xl"></i>
									<?php endif; ?>
								</div>
							

								<!-- File Input -->
								<label for="profile_photo"
									 style="color:black">
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
									<a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('profile.edit')); ?>">
										<i class="align-middle me-2" data-feather="user"></i>
										<span>Profile</span>
									</a>

									<form method="POST" action="<?php echo e(route('logout')); ?>">
										<?php echo csrf_field(); ?>
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
			<main class="content py-4 ">
			
				<div id="content-container">
					<?php echo $__env->yieldContent('customer_layout'); ?>
					<?php echo $__env->yieldContent('shop'); ?>
					<?php echo $__env->yieldContent('home'); ?>
					<?php echo $__env->yieldContent('content'); ?>
				</div>	
			</main>

			<!-- Footer -->
			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a style="text-white" href="#" target="_blank"><strong>ConnectingNotes</strong></a> &copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								
								<li class="list-inline-item text-white"><a style="text-white"  href="#">Support</a></li>
								<li class="list-inline-item text-white"><a style="text-white"  href="#">Privacy</a></li>
								<li class="list-inline-item text-white"><a style="text-white"  href="#">Terms</a></li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="<?php echo e(asset('admin_asset/js/app.js')); ?>"></script>
	<?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

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
		const url = '<?php echo e(route('customer.store.view')); ?>';
		$.ajax({
			url: url,
			method: 'GET',
			success: function(response) {
				var content = $(response).find('#content-container').html();
				$('#content-container').html(content);
				history.pushState(null, '', url); // 👈 Update the URL
			}
		});
	});
	
	$('#cart-link').on('click', function(event) {
		console.log("Cart link clicked!");
		event.preventDefault();
		const url = '<?php echo e(route('cart.index')); ?>';
		$.ajax({
			url: url,
			method: 'GET',
			success: function(response) {
				var content = $(response).find('#content-container').html();
				$('#content-container').html(content);
				history.pushState(null, '', url); // 👈 Update the URL
			}
		});
	});
	
	$('#homepage-link').on('click', function(event) {
		console.log("Homepage link clicked!");
		event.preventDefault();
		const url = '<?php echo e(route('customer.dashboard')); ?>';
		$.ajax({
			url: url,
			method: 'GET',
			success: function(response) {
				var content = $(response).find('#content-container').html();
				$('#content-container').html(content);
				history.pushState(null, '', url); // 👈 Update the URL
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

		const response = await fetch("<?php echo e(route('profile.upload')); ?>", {
			method: 'POST',
			headers: {
				'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
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


<script>
	document.getElementById('profileForm').addEventListener('submit', async function (e) {
		e.preventDefault();

		const formData = new FormData();
		const fileField = document.querySelector('#profile_photo');

		formData.append('profile_photo', fileField.files[0]);

		const response = await fetch("<?php echo e(route('profile.upload')); ?>", {
			method: 'POST',
			headers: {
				'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
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
<?php /**PATH C:\music\resources\views/customer/layouts/layout.blade.php ENDPATH**/ ?>