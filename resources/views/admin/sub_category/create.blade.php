@extends('admin.layouts.layout')
@section('title_admin')
    ConnectingNotes | Admin
@endsection
@section('admin_layout')
<center><h1>Create SubCategory</h1></center>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                            <form action="{{route('store.subcat')}}" method="POST">
                                @csrf
                                <label for="subcategory_name" class="fw-bold-mb-2">Give the name of your Sub category</label>
                                <input type="text" name="subcategory_name" class="form-control" placeholder="Electronics">

                                <label for="category_id" class="fw-bold-mb-2">Select Category</label>
                                <select type="text" name="category_id" id="category_id" class="form-control" placeholder="Electronics">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
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

