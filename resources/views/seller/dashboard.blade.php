@extends('seller.layouts.layout')

@section('title_seller')
WebAge | Premium Products
@endsection

@section('seller_layout')
<div class="bg-black max-w-7xl mx-auto">

    <!-- Products Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 animate-fade-in-up">
  
      @if($homepagesetting)
        {{-- FEATURED PRODUCT 1 --}}
        @if($homepagesetting->featuredProduct1)
          <div id="featured_product_1_id" class="bg-black rounded-3xl shadow-xl overflow-hidden transition transform duration-300 hover:scale-[1.02] hover:shadow-[0_0_20px_3px_rgba(255,255,255,0.4)] animate-fade-in-up">
            <div class="px-6 pt-6">
              <h4 class="text-xs uppercase tracking-widest text-white">
                {{ $homepagesetting->discount_heading }}
              </h4>
              <p class="text-sm text-gray-300 mt-1">
                {{ $homepagesetting->discount_subheading }}
              </p>
            </div>
  
            <div class="p-4">
              <img src="{{ asset('storage/' . optional($homepagesetting->featuredProduct1->images->first())->img_path ?? 'images/fallback.jpg') }}"
                   alt="Product 1"
                   class="w-full h-64 object-cover rounded-2xl shadow-lg">
            </div>
  
            <div class="p-6">
              <h3 class="text-2xl font-semibold text-white">
                {{ $homepagesetting->featuredProduct1->product_name }}
              </h3>
              <p class="text-red-600 font-bold mt-2">
                {{ $homepagesetting->discounted_amount }}% OFF
              </p>
              <div class="mt-5 flex items-center justify-between">
                <span class="text-2xl font-bold text-white">
                  Php {{ number_format($homepagesetting->featuredProduct1->regular_price,2) }}
                </span>
               <a href="">
                  <button class="px-5 py-2 bg-white text-black font-semibold rounded-full transition hover:bg-black hover:text-white">
                    Add to Wishlist
                  </button>
                </a>
              </div>
            </div>
          </div>
        @else
          <div class="text-white bg-gray-800 p-6 rounded-3xl shadow-lg animate-fade-in-up">
            <h3 class="text-xl font-bold">No Featured Product 1 Available</h3>
            <p class="text-gray-400 mt-2">Please check back later for updates.</p>
          </div>
        @endif
  
        {{-- FEATURED PRODUCT 2 --}}
        @if($homepagesetting->featuredProduct2)
          <div id="featured_product_2_id" class="bg-black rounded-3xl shadow-xl overflow-hidden transition transform duration-300 hover:scale-[1.02] hover:shadow-[0_0_20px_3px_rgba(255,255,255,0.4)] animate-fade-in-up">
            <div class="px-6 pt-6">
              <h4 class="text-xs uppercase tracking-widest text-white">
                {{ $homepagesetting->discount_heading }}
              </h4>
              <p class="text-sm text-gray-300 mt-1">
                {{ $homepagesetting->discount_subheading }}
              </p>
            </div>
  
            <div class="p-4">
              <img src="{{ asset('storage/' . optional($homepagesetting->featuredProduct2->images->first())->img_path ?? 'images/fallback.jpg') }}"
                   alt="Product 2"
                   class="w-full h-64 object-cover rounded-2xl shadow-lg">
            </div>
  
            <div class="p-6">
              <h3 class="text-2xl font-semibold text-white">
                {{ $homepagesetting->featuredProduct2->product_name }}
              </h3>
              <p class="text-red-600 font-bold mt-2">
                {{ $homepagesetting->discounted_amount }}% OFF
              </p>
              <div class="mt-5 flex items-center justify-between">
                <span class="text-2xl font-bold text-white">
                  Php {{number_format($homepagesetting->featuredProduct2->regular_price, 2)}}
                </span>
                <a href="">
                  <button class="px-5 py-2 bg-white text-black font-semibold rounded-full transition hover:bg-black hover:text-white">
                    Add to Wishlist
                  </button>
                </a>
              </div>
            </div>
          </div>
        @else
          <div class="text-white bg-gray-800 p-6 rounded-3xl shadow-lg animate-fade-in-up">
            <h3 class="text-xl font-bold">No Featured Product 2 Available</h3>
            <p class="text-gray-400 mt-2">Stay tuned for our next great deal!</p>
          </div>
        @endif
      @else
        <div class="col-span-2 text-center text-white bg-gray-900 p-8 rounded-3xl shadow-xl animate-fade-in-up">
          <h2 class="text-2xl font-bold">Kindly wait for more discounted products.</h2>
          <p class="text-gray-400 mt-2">No featured product.</p>
        </div>
      @endif
    </div>

    <!-- Website Introduction Section -->
    <div class="text-center bg-gray-900 text-white py-12 mt-16 rounded-xl shadow-xl animate-fade-in-up">
        <h2 class="text-3xl font-bold">Welcome to WebAge!</h2>
        <p class="text-lg mt-4 max-w-2xl mx-auto">We offer premium products at unbeatable prices. Our goal is to provide you with the best shopping experience, featuring high-quality, discounted items. Explore our wide selection of products and make the most of the current offers.</p>
        <a href="#products" class="mt-6 inline-block px-6 py-3 bg-red-600 text-white rounded-full text-lg transition hover:bg-red-500">
            Explore Products
        </a>
    </div>
</div>
@endsection

<style>
  @keyframes fadeIn {
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
      animation: fadeIn 1s ease-out forwards;
  }
</style>
