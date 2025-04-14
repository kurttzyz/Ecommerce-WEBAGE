@extends('admin.layouts.layout')
@section('title_admin')
Category - Admin Panel
@endsection
@section('admin_layout')
<center><h1>Edit Category</h1></center>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                            <form action="{{route('update.cat', $category_info->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <label for="category-name" class="fw-bold-mb-2">Give the name of your category</label>
                                <input type="text" name="category_name" class="form-control" value="{{$category_info->category_name}}">
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
                                <button type="submit" class="btn btn-primary w-100 mt-2">Update Category</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

