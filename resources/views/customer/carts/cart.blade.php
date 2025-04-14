@extends('customer.layouts.layout')

@section('title_customer')
WebAge - My Cart
@endsection

@section('customer_layout') 
<center><h1 class="text-white animate-fade-in-up">My Cart</h1></center>
<hr class="my-4 border-green-500 animate-fade-in-up">
  <!-- Back Button -->
  <div class="animate-fade-in-up">
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

<div class="container mx-auto p-6">
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false
        });
    </script>
    @endif

    @if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#d33'
        });
    </script>
    @endif

    <!-- Grid layout for cart items -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($cart->items as $item)
        <div class="bg-black text-white shadow-lg p-4 rounded-lg flex flex-col items-start hover:bg-white hover:text-black hover:shadow-white hover:shadow-md transition-all duration-300 animate-fade-in-up">
            <h2 class="text-lg font-semibold text-center w-full text-white">{{ $item->product->product_name }}</h2>
            <p class="text-center text-white-600 w-full">₱ {{number_format($item->product->regular_price,2) }} x {{ $item->quantity }}</p>

            <!-- Product Image -->
            <div class="w-full mt-3 flex justify-center">
                <img 
                    src="{{ asset('storage/' . $item->product->images->first()->img_path) }}" 
                    class="w-full h-auto max-h-40 object-contain rounded-lg"
                >
            </div>

            <!-- Quantity Buttons -->
            <div class="flex items-center mt-4 space-x-2 w-full">
                <!-- Decrease -->
                <form action="{{ route('cart.decrease', $item->id) }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full text-black bg-gray-200 px-4 py-2 rounded-md font-medium hover:bg-gray-300">
                        <span class="font-semibold text-lg">-</span>
                    </button>
                </form>

                <!-- Increase -->
                <form action="{{ route('cart.increase', $item->id) }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full text-black bg-gray-200 px-4 py-2 rounded-md font-medium hover:bg-gray-300">
                        <span class="font-semibold text-lg">+</span>
                    </button>
                </form>

                <!-- Delete -->
                <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Remove this item?')" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded-md font-medium">
                        Delete
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>


    <!-- Order Summary Section -->
    <div class="mt-10 bg-black shadow-lg rounded-lg p-6 max-w-md mx-auto text-white-800 animate-fade-in-up">
        <h2 class="text-white text-2xl font-bold mb-4 text-center">Order Summary</h2>
        @php
            $totalItems = $cart->items->sum('quantity');
            $subtotal = $cart->items->sum(function($item) {
                return $item->product->regular_price * $item->quantity;
            });
        @endphp

        <div class="flex justify-between mb-2">
            <span class="font-medium">Total Items:</span>
            <span>{{ $totalItems }}</span>
        </div>
        <div class="flex justify-between mb-2">
            <span class="font-medium">Subtotal:</span>
            <span>₱ {{ number_format($subtotal, 2) }}</span>
        </div>

        @php
        $taxRate = 0.02; // 12% example
        $taxAmount = $subtotal * $taxRate;
        $total = $subtotal + $taxAmount;
        @endphp
        <!-- then in the HTML -->
        <div class="flex justify-between mb-2">
            <span class="font-medium">Tax:</span>
            <span>₱ 
            {{ number_format($taxAmount, 2)}} </span>
        </div>
      
        <div class="border-t border-gray-300 my-4"></div>
        <div class="flex justify-between text-xl font-bold">
            <span>Total:</span>
            <span>₱ {{ number_format($total, 2) }}</span>
        </div>
        
        

        <form action="{{ route('customer.orders.payment') }}" method="POST" class="mt-6">
            @csrf
            <button type="submit" class="bg-green-500 hover:bg-green-600 w-full text-white py-2 px-4 rounded-md font-semibold">
                Proceed to Checkout
            </button>
            <p class="mt-4 text-center text-gray-700 font-medium">
                After clicking <strong class="underline text-white">Proceed to Checkout</strong> kindly check your pending orders at Order History to confirm it.
            </p>
        </form>
    </div>

</div>
@endsection

<style>
@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

.animate-fade-in-up {
    animation: fadeIn 1s ease-out forwards;
}
</style>
