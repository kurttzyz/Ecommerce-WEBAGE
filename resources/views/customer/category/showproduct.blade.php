@extends('customer.layouts.layout')

@section('title_customer')
ConnectingNotes
@endsection

@section('customer_layout')

<center>
    <h1 class="text-white text-2xl font-bold animate-fade-in-up">Explore Our All Courses In {{ $category->category_name }} Category</h1>
</center>
<hr class="my-4 border-green-500 animate-fade-in-up">

<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
    @forelse($product as $pro)
        <div class="bg-black shadow rounded overflow-hidden transform hover:scale-105 transition duration-300 ease-in-out animate-fade-in-up">
            <img 
                src="{{ asset('storage/' . $pro->images->first()->img_path) }}" 
                class="w-full h-32 sm:h-36 md:h-40 object-cover"
            >
            <div class="p-2 text-center">
                <h2 class="text-white text-sm font-medium truncate">
                    {{ $pro->product_name }}
                </h2>
               
                <a href="{{ route('category.view', ['product_name' => $pro->product_name]) }}"
                   class="mt-2 inline-block bg-white text-black hover:bg-green-500 hover:text-white text-xs px-3 py-1 rounded transition duration-300">
                    View Details
                </a>
            </div>
        </div>
    @empty
        <p class="col-span-full text-gray-500 animate-fade-in-up">No courses available.</p>
    @endforelse
</div>

<!-- Fade Animation Style -->
<style>
@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in-up {
    animation: fadeInUp 0.6s ease-out both;
}
</style>
@endsection
