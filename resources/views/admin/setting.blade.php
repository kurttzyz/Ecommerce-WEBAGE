@extends('admin.layouts.layout')
@section('title_admin')
Settings - Admin Panel
@endsection
@section('admin_layout')
<center><h1>Home Page Setting</h1></center>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                            <form action="{{route('admin.homepagesetting.update')}}" method="POST">
                                @csrf
                                @method('PUT')
                                <label for="discounted_product_id" class="fw-bold mb-2">Select Discounted Product</label>
                                <select name="discounted_product_id" id="discounted_product_id" class="form-control mb-2">
                                    @foreach ($products as $product)
                                    <option value="{{$product->id}}"{{$homepagesetting->discounted_product_id == $product->id?
                                        'selected':''}}>{{$product->product_name}}</option>
                                    @endforeach
                                </select>

                                <label for="discounted_amount" class="fw-bold my-2">Provide Discount Percent</label>
                                <input type="number" class="form-control" value="{{$homepagesetting->discounted_amount}}" name="discounted_amount">

                                <label for="discount_heading" class="fw-bold my-2">Provide Heading</label>
                                <input type="text" class="form-control" value="{{$homepagesetting->discount_heading}}" name="discount_heading">

                                <label for="discount_subheading" class="fw-bold my-2">Provide Sub Text</label>
                                <input type="text" class="form-control"  value="{{$homepagesetting->discount_subheading}}" name="discount_subheading">

                                <label for="featured_product_1_id" class="fw-bold mb-2">Select Featured Product 1</label>
                                <select name="featured_product_1_id" id="featured_product_1_id" class="form-control my-2">
                                    @foreach ($products as $product)
                                    <option value="{{$product->id}}" {{$homepagesetting->featured_product_1_id == $product->id?
                                        'selected':''}}>{{$product->product_name}}</option>
                                    @endforeach
                                </select>

                                <label for="featured_product_2_id" class="fw-bold mb-2">Select Featured Product 2</label>
                                <select name="featured_product_2_id" id="featured_product_2_id" class="form-control my-2">
                                    @foreach ($products as $product)
                                    <option value="{{$product->id}}" {{$homepagesetting->featured_product_2_id == $product->id?
                                        'selected':''}}>{{$product->product_name}}</option>
                                    @endforeach
                                </select>


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
                                <button type="submit" class="btn btn-primary w-100 mt-2">Update Homepage Setting</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
