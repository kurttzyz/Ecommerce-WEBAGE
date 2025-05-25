@extends('seller.layouts.layout')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-VW7c0bZ7A4jKzSgHdkN1ax7bNn8mwPboA5zG9QqlRg9O3jsLWe4oQY9+QAYuqlcZ" crossorigin="anonymous">
@section('title_seller')
Mentors - ConnectingNotes
@endsection
@section('seller_layout')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                        <center>
                            <h1 class="text-black">Create A New Mentor</h1>
                        </center>

                        <hr class="my-4 border-black animate-fade-in-up">
                            <form action="{{route('create.store')}}" method="POST">
                                @csrf
                                <label for="store_name" class="fw-bold-mb-2">Mentor's Name</label>
                                <input type="text" name="store_name" class="form-control" placeholder="Create your Mentor name">
                                <br>
                                <label for="details" class="fw-bold-mb-2">Description</label>
                                <textarea type="text" cols="3" rows="3" name="details" class="form-control" placeholder="Create your Mentor Description..."></textarea>
                                <br>
                                <label for="slug" class="fw-bold-mb-2">Slug</label>
                                <input type="text" name="slug" class="form-control" placeholder="Create your slug name Ex.(MyMentor) -> (www.ConnectingNotes/MyMentor.com)">
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
                                <br>
                                <button type="submit" class="btn btn-primary w-100 mt-2">Create Mentor</button>
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

