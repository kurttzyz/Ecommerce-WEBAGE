@extends('admin.layouts.layout')
@section('title_admin')
    ConnectingNotes | Admin
@endsection
@section('admin_layout')
<center><h1>Edit Sub Category</h1></center>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                            <form action="{{route('update.subcat', $subcategory_info->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <label for="subcategory_name" class="fw-bold-mb-2">Give the name of your sub category</label>
                                <input type="text" name="subcategory_name" class="form-control" value="{{$subcategory_info->subcategory_name}}">
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
                                <button type="submit" class="btn btn-primary w-100 mt-2">Update Sub Category</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

