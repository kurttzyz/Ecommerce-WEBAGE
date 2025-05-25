@extends('seller.layouts.layout')

@section('title_seller')
    ConnectingNotes
@endsection

@section('seller_layout')
    <div>
        <center>
            <h1 class="text-2xl font-bold mb-4 text-black">My Courses</h1>
        </center>
        <hr class="my-4 border-black animate-fade-in-up">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">

            @foreach ($courses as $course)
                <div class="relative bg-white rounded-lg shadow p-4">

                    <!-- Delete Course Button in Upper Right -->
                    <form action="{{ route('courses.archive', $course->id) }}" method="POST" onsubmit="return confirm('Archive this course?')"> class="absolute top-2 right-2 z-10">
                        @csrf

                        <button type="submit"
                            class="text-red-500 hover:text-red-700 font-bold text-s">
                            <i class="fas fa-archive"> Archive Course</i>
                        </button>
                    </form>

                    <h2 class="text-lg font-semibold text-gray-800 mt-4">{{ $course->title }}</h2>
                    <p class="text-gray-600 mt-2">{{ $course->description }}</p>

                    <div class="mt-4">
                        <a href="{{ route('courses.show', $course) }}">View</a>
                        <a href="{{ route('courses.edit', $course) }}" class="ml-4 text-yellow-500 hover:underline">Edit</a>
                        @php $sessionCount = $course->sessions->count(); @endphp

                        <a href="{{ route('sessions.create', ['courseId' => $course->id]) }}"
                            class="ml-4 text-blue-500 hover:underline {{ $sessionCount >= 2 ? 'pointer-events-none opacity-50 cursor-not-allowed' : '' }}"
                            {{ $sessionCount >= 2 ? 'aria-disabled=true' : '' }}>
                            {{ $sessionCount >= 2 ? 'Max Sessions Created' : 'Add Session' }}
                        </a>

                    </div>
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