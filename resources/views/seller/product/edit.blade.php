@extends('seller.layouts.layout')
@section('title_seller')
Edit Course - ConnectingNotes
@endsection
@section('seller_layout')
    <div class="row">
        <center><h5 style="color:black">Edit Your Course</h5></center>
        <hr class="my-4 border-black animate-fade-in-up">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @if ($errors->any())
                    <div class="alert alert-warning alert-dismissible fade show">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif


                </div>
                <div class="card-body">
                    <form action="{{ route('update.product', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <label for="product_name" class="fw-bold mb-2">Course Name</label>
                        <input type="text" name="product_name" class="form-control" value="{{ $product->product_name }}">

                        <label for="description" class="fw-bold mb-2">Course Description</label>
                        <textarea name="description" rows="5" class="form-control">{{ $product->description }}</textarea>

                        <label for="images" class="fw-bold mb-2">Current Images</label>
                        <div class="mb-3">
                            @foreach($product->images as $image)
                                <img src="{{ asset('storage/' . $image->img_path) }}" class="img-thumbnail" width="100">
                            @endforeach
                        </div>

                        <label for="images" class="fw-bold mb-2">Upload New Course Images</label>
                        <input type="file" name="images[]" class="form-control" multiple>

                        <label for="sku" class="fw-bold mb-2">SKU</label>
                        <input type="text" name="sku" class="form-control" value="{{ $product->sku }}">

                        <livewire:category-subcategory/>

                        <label for="store_id" class="fw-bold mb-2">Select Your Mentor</label>
                        <select name="store_id" id="store_id" class="form-control mb-2">
                            @foreach($stores as $store)
                            <option value="{{ $store->id }}" {{ $product->store_id == $store->id ? 'selected' : '' }}>
                                {{ $store->store_name }}
                            </option>
                            @endforeach
                        </select>

                        <label for="regular_price" class="fw-bold mb-2">Regular Price</label>
                        <input type="number" name="regular_price" class="form-control mb-2" value="{{ $product->regular_price }}">

                        <label for="discounted_price" class="fw-bold mb-2">Discounted Price</label>
                        <input type="number" name="discounted_price" class="form-control" value="{{ $product->discounted_price }}">

                        <label for="tax_rate" class="fw-bold mb-2">Tax Rate</label>
                        <input type="number" name="tax_rate" class="form-control" value="{{ $product->tax_rate }}" readonly>

                        <label for="stock_quantity" class="fw-bold mb-2">Stock Quantity</label>
                        <input type="number" name="stock_quantity" class="form-control" value="{{ $product->stock_quantity }}">

                        <label for="slug" class="fw-bold mb-2">Slug</label>
                        <input type="text" name="slug" class="form-control" value="{{ $product->slug }}">

                        <label for="meta_title" class="fw-bold mb-2">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control mb-2" value="{{ $product->meta_title }}">

                        <label for="meta_description" class="fw-bold mb-2">Meta Description</label>
                        <input type="text" name="meta_description" class="form-control mb-2" value="{{ $product->meta_description }}">

                        <button type="submit" class="btn btn-primary w-100 mt-2">Update Course</button>
                    </form>
                </div>
            </div>
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