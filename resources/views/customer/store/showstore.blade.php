@extends('customer.layouts.layout')

@section('title_customer')
WebAge
@endsection

@section('customer_layout')
<div class="container mx-auto p-6 space-y-10 bg-gray-950 min-h-screen">

    <div>
        <a href="{{ url()->previous() }}"
           class="inline-flex items-center text-green-400 hover:text-green-300 transition duration-200 mb-4">
            <!-- Heroicon: Arrow Left -->
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Back
        </a>
    </div>

    <!-- Store Card -->
    <div class="bg-gray-900 rounded-2xl shadow-lg overflow-hidden border border-green-800 animate-fade-in-up">

        <!-- Store Header -->
        <div class="bg-gradient-to-r from-green-600 to-green-800 p-6 text-white rounded-t-2xl">
            <h2 class="text-4xl font-bold">{{ $viewstores->store_name }}</h2>
            <p class="text-sm opacity-90">{{ $viewstores->slug }}</p>
        </div>

        <!-- Store Body -->
        <div class="p-6 space-y-6 animate-fade-in">
            <!-- Store Details -->
            <div>
                <h3 class="text-xl font-semibold text-green-300 mb-2">About the Store</h3>
                <p class="text-green-100 leading-relaxed">{{ $viewstores->details }}</p>
            </div>

            <!-- Store Design Section -->
            <div>
                <h3 class="text-lg font-semibold text-green-300 mb-3">Store Highlights</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="bg-gray-800 p-4 rounded-xl shadow hover:shadow-md transition-transform transform hover:-translate-y-1 duration-300">
                        <h4 class="font-bold text-green-400 text-lg">Fast Shipping</h4>
                        <p class="text-sm text-green-100">Quick and reliable delivery across the region.</p>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-xl shadow hover:shadow-md transition-transform transform hover:-translate-y-1 duration-300">
                        <h4 class="font-bold text-green-400 text-lg">Secure Payments</h4>
                        <p class="text-sm text-green-100">Your transactions are protected with top-level security.</p>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-xl shadow hover:shadow-md transition-transform transform hover:-translate-y-1 duration-300">
                        <h4 class="font-bold text-green-400 text-lg">Top-Rated Products</h4>
                        <p class="text-sm text-green-100">Best-sellers and highly reviewed items available.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Custom Animations -->
<style>
@keyframes fadeIn {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
}
.animate-fade-in-up {
    animation: fadeIn 0.8s ease-out both;
}
.animate-fade-in {
    animation: fadeIn 1.2s ease-out both;
}
</style>
@endsection
