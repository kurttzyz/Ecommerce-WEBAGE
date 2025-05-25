@extends('seller.layouts.layout')

@section('title_seller')
    ConnectingNotes
@endsection

@section('seller_layout')
    <div>
        <center>
            <h1 class="text-2xl font-bold mb-4 text-black">Archived Courses</h1>
        </center>
        <hr class="my-4 border-black animate-fade-in-up">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
            @foreach ($archivedCourses as $course)
                <div class="relative bg-gray-100 rounded-lg shadow p-4 opacity-70">

                    <form action="{{ route('courses.unarchive', $course->id) }}" method="POST"
                        onsubmit="return confirm('Unarchive this course?')">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="text-blue-500 hover:text-blue-500 font-bold text-xl">
                            <i class="fas fa-archive"></i> Unarchive Course</button>
                        </form>

                    <h2 class="text-lg font-semibold text-gray-600 mt-4">{{ $course->title }}</h2>
                    <p class="text-gray-500 mt-2">{{ $course->description }}</p>


                </div>

            @endforeach
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