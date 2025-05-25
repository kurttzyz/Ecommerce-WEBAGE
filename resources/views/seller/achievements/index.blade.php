@extends('seller.layouts.layout')

@section('title_seller')
    ConnectingNotes
@endsection

@section('seller_layout')
    <div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
        <center><h2 class="text-2xl font-semibold mb-4">Assign Achievements to Students</h2></center>
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

        <div class="space-y-4">

            <form action="{{ route('assign.achievement.single') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="student_id" style="color:black">Select Student</label>
                    <select name="student_id" id="student_id" required class="border rounded p-2 w-full text-black">
                        <option value="" disabled selected>Select a student</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->full_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="achievement_id" style="color:black">Select Achievement</label>
                    <select name="achievement_id" id="achievement_id" required class="border rounded p-2 w-full text-black">
                        <option value="" disabled selected>Select an achievement</option>
                        @foreach($achievements as $achievement)
                            <option value="{{ $achievement->id }}">{{ $achievement->title }}</option>
                        @endforeach
                    </select>
                </div>

                <center><button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Assign Achievement</button></center>
            </form>

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