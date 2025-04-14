@extends('seller.layouts.layout')
@section('title_seller')
Create Store - Seller Panel
@endsection
@section('seller_layout')
<center><h1 class="text-white">Create a new store</h1></center>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                            <form action="{{route('create.store')}}" method="POST">
                                @csrf
                                <label for="store_name" class="fw-bold-mb-2">Give the name of your new store</label>
                                <input type="text" name="store_name" class="form-control" placeholder="Create your store name">

                                <label for="details" class="fw-bold-mb-2">Description of your store</label>
                                <textarea type="text" cols="30" rows="10" name="details" class="form-control" placeholder="Create your store Description..."></textarea>

                                <label for="slug" class="fw-bold-mb-2">Slug</label>
                                <input type="text" name="slug" class="form-control" placeholder="Create your slug name Ex.(MyStore) -> (www.WebAge/MyStore)">
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
                                <button type="submit" class="btn btn-primary w-100 mt-2">Create Store</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

