@extends('seller.layouts.layout')

@section('title_seller')
    ConnectingNotes
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

        <center>
            <h1 style="color:black">Issue Achievements</h1>
        </center>
        <hr class="my-4 border-black animate-fade-in-up">

        <div class="max-w-4xl mx-auto p-6 bg-white rounded shadow space-y-6">

            {{-- Achievement Info --}}
            <div>
                <h2 class="text-xl font-bold">Achievement: {{ $achievement->title }}</h2>
                <p class="text-gray-600">{{ $achievement->description }}</p>
            </div>

            {{-- Form with Dropdown --}}
            <form action="{{ route('asign.achievements.dropdown') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="achievement_id" value="{{ $achievement->id }}">

                <label for="student_id" class="block text-gray-700 font-medium">Select Student:</label>
                <select name="student_id" id="student_id" required
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="" disabled selected>Choose a student</option>
                    @foreach ($students as $student)
                        <option value="{{ $student->student_id }}">{{ $student->full_name }}</option>
                    @endforeach
                </select>

                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow">
                    Assign Achievement
                </button>
            </form>

            {{-- Assigned Status List --}}
            <div class="space-y-4 mt-8">
                <h2 class="text-xl font-bold">Achievement Status</h2>
                @foreach($students as $student)
                    @if(in_array($student->student_id, $assigned))
                        <div class="p-4 bg-green-50 border rounded">
                            <span class="text-green-600 font-semibold">{{ $student->full_name }} ✔ Completed</span>
                        </div>
                    @endif
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