@extends('seller.layouts.layout')

@section('title_seller')
    Edit Course - ConnectingNotes
@endsection

@section('seller_layout')
<div>
    <a href="{{ url()->previous() }}"
        class="inline-flex items-center text-black hover:text-blue transition duration-200 mb-4">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
        Back
    </a>
</div>


        <div class="bg-white px-4 py-4 max-w-lg mx-auto">
            <center>
                <h1 class="text-2xl font-bold mb-4 text-black">Edit Course</h1>
                </center>
                <hr class="my-4 border-black animate-fade-in-up">
            @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: '{{ session('success') }}',
                        confirmButtonColor: '#3085d6',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                </script>
            @endif

            @if (session('error'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: '{{ session('error') }}',
                        confirmButtonColor: '#d33'
                    });
                </script>
            @endif

            <form method="POST" action="{{ route('courses.update', $course->id) }}">
                @csrf
                @method('PUT') <!-- This is important to make a PUT request for updates -->

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-black">Course Title</label>
                    <input type="text" name="title" class="w-full border px-3 py-2 rounded text-black"
                        value="{{ old('title', $course->title) }}" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-black">Description</label>
                    <textarea name="description"
                        class="w-full border px-3 py-2 rounded text-black">{{ old('description', $course->description) }}</textarea>
                </div>

                <center><button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Update</button></center>
            </form>
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