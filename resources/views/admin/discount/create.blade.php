@extends('admin.layouts.layout')
@section('title_admin')
Discount - Admin Panel
@endsection
@section('admin_layout')
<center><h1>Home Page Setting</h1></center>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                            <form action="" method="POST">
                                @csrf
                                <label for="discounted_product_id" class="fw-bold-mb-2">Select Discounted Product</label>
                                <select name="discounted_product_id" id="discounted_product_id" class="form-control mb-2">
                                    @foreach ($products as $product)
                                    <option value="{{$product->id}}">{{$product->product_name}}</option>
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
                                <button type="submit" class="btn btn-primary w-100 mt-2">Create</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

