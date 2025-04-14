@extends('admin.layouts.layout')
@section('title_admin')
Attribute - Admin Panel
@endsection
@section('admin_layout')
<center><h1>Manage Product Attribute</h1></center>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">All Default Attributes</h5>
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
                                        <th>Attribute</th>
                                        <th>Action</th>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($allattributes as $attribute)
                                    <tr>
                                        <td>{{$attribute->id}}</td>
                                        <td>{{$attribute->attribute_value}}</td>
                                        <td><a href="{{route('show.attribute', $attribute -> id)}}" class="btn btn-info">Edit</a>
                                            <form method="POST" action="{{route('delete.attribute', $attribute->id)}}">
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

