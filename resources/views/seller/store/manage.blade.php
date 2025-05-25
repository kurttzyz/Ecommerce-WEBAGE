@extends('seller.layouts.layout')

@section('title_seller')
    Update Mentor - ConnectingNotes
@endsection
@section('seller_layout')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4 ">
                    <center>
                        <h1>All Mentor</h1>
                    </center>
                    <hr class="my-4 border-black animate-fade-in-up">
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
                                        <th>Mentor Name</th>
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
                                            <td>
                                                <div class="d-flex py-0">
                                                    <a href="{{route('edit.store', $store->id)}}" class="btn btn-info mb-4">Edit</a>
                                                    <form method="POST" action="{{ route('delete.store', $store->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete the mentor?')">
                                                            Delete
                                                        </button>
                                                    </form>

                                                </div>
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