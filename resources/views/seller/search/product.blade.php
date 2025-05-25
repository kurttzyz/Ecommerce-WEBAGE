@extends('seller.layouts.layout')

@section('title_seller')
    ConnectingNotes
@endsection

@section('seller_layout')
<div class="search-results animate-fade-in" style="padding: 20px; font-family: Arial, sans-serif; color: #333;">
    <h2 style="font-size: 24px; margin-bottom: 20px; color: #007bff;">Search Results for: "{{ $query }}"</h2>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
    @if($products->isEmpty())
        <p style="font-size: 18px; color: #666;">No courses found.</p>
    @else
    
        <ul style="list-style-type: none; padding: 0;">
            @foreach($products as $product)
                <div class="bg-white shadow rounded overflow-hidden mb-4 animate-fade-in-up">
                    <img 
                        src="{{ asset('storage/' . $product->images->first()->img_path) }}" 
                        class="w-full h-32 sm:h-36 md:h-40 object-cover"
                    >
                    <div class="p-2 text-center">
                        <h2 class="text-sm font-medium truncate">
                            {{ $product->product_name }}
                        </h2>
                        <div class="text-indigo-600 font-bold text-sm mt-1">
                            ₱ {{ number_format($product->regular_price, 2) }}
                        </div>
                        <a href="{{ route('seller.category.view', ['product_name' => $product->product_name]) }}" class="mt-2 inline-block bg-black hover:bg-green-500 text-white text-xs px-3 py-1 rounded">
                            View Details
                        </a>
                    </div>
                </div>
            @endforeach
        </ul>
    @endif
    </div>
</div>
@endsection

<style>
    /* Tailwind CSS fade-in animation */
    @keyframes fade-in {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

    .animate-fade-in {
        animation: fade-in 1s ease-out;
    }

    .animate-fade-in-up {
        animation: fade-in 1s ease-out;
    }
</style>
