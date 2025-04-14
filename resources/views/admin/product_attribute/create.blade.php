@extends('admin.layouts.layout')
@section('title_admin')
Product Attribute - Admin Panel
@endsection
@section('admin_layout')
<center><h1>Create Default Attribute</h1></center>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                            <form action="{{route('attribute.create')}}" method="POST">
                                @csrf
                                <label for="attribute_value" class="fw-bold-mb-2">Give the name of your attribute</label>
                                <input type="text" name="attribute_value" class="form-control" placeholder="XL">
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
                                <button type="submit" class="btn btn-primary w-100 mt-2">Add Attribute</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

