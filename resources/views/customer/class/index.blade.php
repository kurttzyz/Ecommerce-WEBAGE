@extends('customer.layouts.layout')

@section('title_customer')
    ConnectingNotes
@endsection

@section('customer_layout')
    <div>

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
        <center><h1 class="text-3xl font-bold mb-4 text-black">My Courses</h1></center>
        <hr class="my-4 border-black animate-fade-in-up">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
            @foreach ($courses as $course)
                <div class="rounded-lg shadow p-4 bg-cover bg-center" >
                    <div class="relative rounded overflow-hidden">
                        <div class="absolute inset-0 bg-black bg-opacity-40 z-0"
                            style="background-image: url('{{ asset('landingpage/img/room.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                        </div>
                        <div class="relative z-10 p-4">


                        <div class="course-card" >
                            <h3 style="color:white; text-align:center" class="bg-gray-600">{{ $course->title }}</h3>
                           <br><br>
                           <br>
                           <br>
                           <br>
                </div>

      
                <center>
                    <a href="{{ route('classroom.show', $course->id) }}"
                        class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition duration-200">
                        Enter Class
                    </a>
                </center>

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