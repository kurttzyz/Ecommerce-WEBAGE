@extends('seller.layouts.layout')
@section('title_seller')
Courses - ConnectingNotes
@endsection
@section('seller_layout')
    <div class="row">
        <center><h1 style="color:black">Add Featured Course</h1></center>
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
                            <form action="{{route('seller.product.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label for="product_name" class="fw-bold mb-2">Give The Name Of Your Course</label>
                                <input type="text" name="product_name" class="form-control" placeholder="Enter your course name">

                                <label for="description" class="fw-bold mb-2">Give The Description Of Your Course</label>
                                <textarea name="description" rows="5" cols="15" class="form-control" placeholder="Your course desciption"></textarea>

                                <label for="images" class="fw-bold mb-2">Upload Your Course Images</label>
                                <input type="file" name="images[]" class="form-control" multiple>

                                <label for="sku" class="fw-bold mb-2">SKU</label>
                                <input type="text" name="sku" class="form-control" placeholder="Enter your sku">

                                <livewire:category-subcategory/>

                                <label for="store_id" class="fw-bold mb-2">Select Your Mentor For This Course</label>
                                <select name="store_id" id="store_id" class="form-control mb-2">
                                    @foreach($stores as $store)
                                    <option value="{{$store->id}}">{{$store->store_name}}</option>
                                    @endforeach
                                </select>

                                <label for="regular_price" class="fw-bold mb-2">Course Regular Price</label>
                                <input type="number" name="regular_price" class="form-control mb-2" placeholder="Enter your course price">

                                <label for="discounted_price" class="fw-bold mb-2">Discounted Price</label>
                                <input type="number" name="discounted_price" class="form-control" placeholder="Enter your discounted price (Optional).">

                                <label for="tax_rate" class="fw-bold mb-2">Tax</label>
                                <input type="number" name="tax_rate" class="form-control" value="10" readonly>

                                <label for="stock_quantity" class="fw-bold mb-2">Sessions</label>
                                <input type="number" name="stock_quantity" class="form-control" placeholder="Enter sessions" >

                                <label for="slug" class="fw-bold mb-2">Slug</label>
                                <input type="text" name="slug" class="form-control" placeholder="Enter slug (www.connectingnotes.com/your-slug)">

                                <label for="meta_title" class="fw-bold mb-2">Meta Title</label>
                                <input type="text" name="meta_title" class="form-control mb-2" placeholder="Enter meta title">

                                <label for="meta_description" class="fw-bold mb-2">Meta Description</label>
                                <input type="text" name="meta_description" class="form-control mb-2" placeholder="Enter meta description">

                                <button type="submit" class="btn btn-primary w-100 mt-2">Add Course</button>
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



