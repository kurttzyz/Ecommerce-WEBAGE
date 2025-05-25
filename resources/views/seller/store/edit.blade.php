@extends('seller.layouts.layout')


@section('title_seller')
Edit Mentor - ConnectingNotes
@endsection
@section('seller_layout')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                        <center>
                            <h1 class="text-black">Edit Mentor</h1>
                        </center>
                        <hr class="my-4 border-black animate-fade-in-up">
                        <form action="{{ route('update.store', $store->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <label for="store_name" class="fw-bold-mb-2">Give the new name of your Mentor</label>
                                <input type="text" name="store_name" class="form-control" value="{{$store->store_name}}">

                                <label for="details" class="fw-bold-mb-2">Give the new Description of your Mentor</label>
                                <textarea cols="30" rows="10" name="details" class="form-control">{{$store->details}}</textarea>


                                <label for="slug" class="fw-bold-mb-2">Give the new slug of your Mentor</label>
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
                                <button type="submit" class="btn btn-primary w-100 mt-2">Update Mentor</button>
                            </form>
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

