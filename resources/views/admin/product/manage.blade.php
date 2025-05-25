@extends('admin.layouts.layout')
@section('title_admin')
ConnectingNotes | Admin
@endsection
@section('admin_layout')
<h1>Manage Session & Courses</h1>

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


        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
            @foreach ($courses as $course)
                <div class="rounded-lg shadow p-4 bg-cover bg-center">
                    <div class="bg-white bg-opacity-80 p-4 rounded"
                        style="background-image: url('{{ asset('landingpage/img/room.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">

                        <div class="course-card">
                            <h3 style="color:black; text-align:center" class="bg-gray-400">{{ $course->title }}</h3>
                            <center><strong style="color:black ; text-align:center" class="bg-gray-400">Total Students: {{ $course->students->count()}}</strong></center>
                            <p class="text-black" style="text-align:center" class="bg-gray-400">
                                <strong class="bg-gray-400">Instructor: {{ $course->course->mentor->full_name ?? 'N/A' }}</strong>
                            </p>
                            <center>
                                <form action="{{ route('product.destroy', $course->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>

                            </center>
                        </div>
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