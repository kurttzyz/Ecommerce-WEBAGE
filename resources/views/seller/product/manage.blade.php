@extends('seller.layouts.layout')
@section('title_seller')
Manage Course - ConnectingNotes 
@endsection
@section('seller_layout')
    <center><h1 class="text-black">All Of Your Course</h1></center>
    <hr class="my-4 border-black animate-fade-in-up">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Course</h5>
                        <div class="card-body">
                            @if(session('success'))
                                                <div class="alert alert-success my-2">
                                                    {{session('success')}}
                                                </div>
                                                @endif
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Course Name</th>
                                            <th>Course Image</th>
                                            <th>Sessions</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($products as $product)
                                        <tr>
                                            <td>{{$product->id}}</td>
                                            <td>{{$product->product_name}}</td>
                                            <td>
                                                @php
    $primaryImage = $product->images()->where('is_primary', true)->first();
                                                @endphp

                                                @if($primaryImage && $primaryImage->img_path)
                                                <img src="{{ Storage::url($primaryImage->img_path) }}" width="80" height="80" alt="Product Image">
                                            @else
                                                <span>No Image</span>
                                            @endif
                                            </td>
                                            <td>{{$product->stock_quantity}}</td>
                                            <td>{{$product->regular_price}}</td>
                                            <td>
                                                <a href="{{route('seller.product.edit', $product->id)}}" class="btn btn-info">Edit</a>
                                                <form method="POST" action="{{route('delete.product', $product->id)}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" value="Delete" class="btn btn-danger">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
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


