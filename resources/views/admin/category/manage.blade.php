@extends('admin.layouts.layout')
@section('title_admin')
    ConnectingNotes | Admin
@endsection
@section('admin_layout')
<center><h1>Manage Category</h1></center>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">All Category</h5>
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
                                        <th>Category Name</th>
                                        <th>Action</th>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($categories as $cat)
                                    <tr>
                                        <td>{{$cat->id}}</td>
                                        <td>{{$cat->category_name}}</td>
                                        <td><a href="{{route('show.cat', $cat->id)}}" class="btn btn-info">Edit</a>
                                            <form method="POST" action="{{route('delete.cat', $cat->id)}}">
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

