<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Commerce')</title>
    @vite('resources/css/app.css')
   
    @livewireStyles
</head>
<body class="bg-black text-white"> <!-- Apply bg-black here and text-white for better contrast -->

    <!-- Navbar -->
    <nav class="bg-white shadow">
        <div class="max-w-screen-xl mx-auto px-4 py-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="/" class="text-2xl font-bold text-blue-600">WebAge-Shop</a>

            <!-- Desktop Search (Hidden on Small Screens) -->
            <div class="hidden lg:block">
                @livewire('product-search-component')
            </div>

            <!-- Mobile Menu Button -->
            <div class="lg:hidden">
                <button @click="open = !open" class="focus:outline-none" x-data="{ open: false }">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-6">
                <a href="/" class="text-gray-700 hover:text-blue-500">Home</a>
                <a href="#" class="text-gray-700 hover:text-blue-500">Shop</a>   
                <livewire:filter-component />                             
                <a href="#" class="text-gray-700 hover:text-blue-500">Cart</a>
                <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-500">Sign In</a>
            </div>
        </div>

        <!-- Mobile Navigation (Toggles Open) -->
        <div x-show="open" x-transition class="lg:hidden bg-white shadow-md mt-2 py-2">
            <a href="/" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Home</a>
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Shop</a>
            <livewire:filter-component />
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Cart</a>
            <a href="{{ route('register') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Sign In</a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="bg-black max-w-screen-xl mx-auto px-4 py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-black shadow py-4 mt-6">
        <div class="max-w-screen-xl mx-auto text-center text-gray-600">
            &copy; 2025 WebAge-Shop. All rights reserved.
        </div>
    </footer>

    @livewireScripts
</body>
</html>
