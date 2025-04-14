<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="bg-black text-white font-sans antialiased">

    <nav class="bg-white text-black shadow-lg py-4">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <!-- Logo -->
            <a href="/" class="text-2xl font-bold text-black hover:text-red-300 transition duration-300">WebAge</a>
    
            <!-- Mobile Hamburger Icon -->
            <button id="mobileMenuToggle" class="md:hidden focus:outline-none">
                <i data-feather="menu" class="w-6 h-6"></i>
            </button>
    
            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8 text-lg">
                <a href="/" class="flex items-center hover:text-red-500 transition duration-300">
                    <i data-feather="home" class="me-2"></i> Home
                </a>
    
                <a href="login/" class="flex items-center hover:text-red-500 transition duration-300">
                    <i data-feather="shopping-cart" class="me-2"></i> Shop
                </a>
    
                <div class="hidden lg:flex items-center hover:text-red-500 transition duration-300 px-6">
                    <i data-feather="filter" class="me-8"></i>
                    
                    @livewire('filter-component')
                </div>
    
                <a href="register/" class="flex items-center hover:text-red-500 transition duration-300">
                    <i data-feather="shopping-bag" class="me-2"></i> Cart
                </a>
    
                <a href="{{ route('login') }}" class="flex items-center hover:text-red-500 transition duration-300">
                    <i data-feather="user" class="me-2"></i> Sign In
                </a>
    
                <!-- Desktop Search -->
                <div class="hidden md:flex items-center space-x-2">
                   
                    @livewire('product-search-component')
                </div>
            </div>
        </div>
    
        <!-- Mobile Menu -->
        <div id="mobileMenu" class="md:hidden hidden px-6 pt-4 pb-6 space-y-4 text-base">
            <a href="/" class="block hover:text-red-500">Home</a>
            <a href="login/" class="block hover:text-red-500">Shop</a>
            <a href="register/" class="block hover:text-red-500">Cart</a>
            <a href="{{ route('login') }}" class="block hover:text-red-500">Sign In</a>
            <div>
                <livewire:product-search-component />
            </div>
            <div>
                <livewire:filter-component />
            </div>
        </div>
    </nav>
    

    <!-- Main Content Area -->
    <main class="bg-black container mx-auto px-6 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-black text-white py-6 mt-8">
        <div class="container mx-auto text-center text-gray-400">
            &copy; 2025 WebAge-Shop. All rights reserved.
        </div>
    </footer>

    @livewireScripts

    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace(); // Replace the data-feather icons with SVGs
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        feather.replace();

        const toggleBtn = document.getElementById('mobileMenuToggle');
        const mobileMenu = document.getElementById('mobileMenu');

        toggleBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    });
</script>


</body>
</html>
