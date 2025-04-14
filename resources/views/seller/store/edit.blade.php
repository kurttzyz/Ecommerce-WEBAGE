@extends('seller.layouts.layout')
@section('title_seller')
Edit Store - WebAge
@endsection
@section('seller_layout')
<center><h1 class="text-white">Edit Store</h1></center>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                    
                        <form action="{{ route('update.store', $store->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <label for="store_name" class="fw-bold-mb-2">Give the new name of your store</label>
                                <input type="text" name="store_name" class="form-control" value="{{$store->store_name}}">

                                <label for="details" class="fw-bold-mb-2">Give the new Description of your store</label>
                                <textarea cols="30" rows="10" name="details" class="form-control">{{$store->details}}</textarea>


                                <label for="slug" class="fw-bold-mb-2">Give the new slug of your store</label>
                                <input type="text" name="slug" class="form-control" value="{{$store->slug}}">

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
                                <button type="submit" class="btn btn-primary w-100 mt-2">Update Store</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

