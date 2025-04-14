@extends('seller.layouts.layout')
@section('title_seller')
Update Store - Seller Panel
@endsection
@section('seller_layout')
<center><h1 class="text-white">All Stores You Created</h1></center>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">All Stores</h5>
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
                                        <th>Store Name</th>
                                        <th>Description</th>
                                        <th>Slug</th>
                                        <th>Action</th>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($stores as $store)
                                    <tr>
                                        <td>{{$store->id}}</td>
                                        <td>{{$store->store_name}}</td>
                                        <td>{{$store->slug}}</td>
                                        <td>{{$store->details}}</td>
                                        <td><a href="{{route('edit.store', $store-> id)}}" class="btn btn-info">Edit</a>
                                            <form method="POST" action="{{route('delete.store', $store->id)}}">
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

