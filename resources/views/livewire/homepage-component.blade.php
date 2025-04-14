@extends('layouts.homepage')

@section('title')
WebAge
@endsection

@section('content')
<div class="bg-black max-w-7xl mx-auto">

  <!-- Products Grid -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

    @if($homepagesetting)
      {{-- FEATURED PRODUCT 1 --}}
      @if($homepagesetting->featuredProduct1)
        <div id="featured_product_1_id" class="bg-black rounded-3xl shadow-xl overflow-hidden transition transform duration-300 hover:scale-[1.02] hover:shadow-[0_0_20px_3px_rgba(255,255,255,0.4)]">
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
                Php {{ $homepagesetting->featuredProduct1->regular_price }}
              </span>
              <a href="register/">
                <button class="px-5 py-2 bg-white text-black font-semibold rounded-full transition hover:bg-black hover:text-white">
                  Add to Cart
                </button>
              </a>
            </div>
          </div>
        </div>
      @else
        <div class="text-white bg-gray-800 p-6 rounded-3xl shadow-lg">
          <h3 class="text-xl font-bold">No Featured Product 1 Available</h3>
          <p class="text-gray-400 mt-2">Please check back later for updates.</p>
        </div>
      @endif

      {{-- FEATURED PRODUCT 2 --}}
      @if($homepagesetting->featuredProduct2)
        <div id="featured_product_2_id" class="bg-black rounded-3xl shadow-xl overflow-hidden transition transform duration-300 hover:scale-[1.02] hover:shadow-[0_0_20px_3px_rgba(255,255,255,0.4)]">
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
                Php {{ $homepagesetting->featuredProduct2->regular_price }}
              </span>
              <a href="register/">
                <button class="px-5 py-2 bg-white text-black font-semibold rounded-full transition hover:bg-black hover:text-white">
                  Add to Cart
                </button>
              </a>
            </div>
          </div>
        </div>
      @else
        <div class="text-white bg-gray-800 p-6 rounded-3xl shadow-lg">
          <h3 class="text-xl font-bold">No Featured Product 2 Available</h3>
          <p class="text-gray-400 mt-2">Stay tuned for our next great deal!</p>
        </div>
      @endif

    @else
      <div class="col-span-2 text-center text-white bg-gray-900 p-8 rounded-3xl shadow-xl">
        <h2 class="text-2xl font-bold">Homepage Settings Not Found</h2>
        <p class="text-gray-400 mt-2">Please configure homepage settings in the admin panel.</p>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

      </div>
    @endif

  </div>
</div>
@endsection
