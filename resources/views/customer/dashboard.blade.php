@extends('customer.layouts.layout')

@section('title_customer')
    ConnectingNotes | Dashboard
@endsection

@section('home')

    {{-- SweetAlert Notifications --}}
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
    <h1 class="text-center font-bold text-black text-3xl">Dashboard</h1>
    <hr class="my-4 border-black animate-fade-in-up">


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
        @if($courses->count())
            @foreach($courses as $course)
                <div class="bg-white shadow-md rounded-2xl overflow-hidden p-4 flex flex-col space-y-4">
                    {{-- Mentor Profile Photo --}}
                    <div class="flex items-center space-x-4">
                        <img src="{{ $course->mentor->profile_photo ? asset('storage/' . $course->mentor->profile_photo) : asset('images/default-avatar.png') }}"
                            alt="Profile" class="w-16 h-16 rounded-full object-cover border border-gray-300">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">{{ $course->title }}</h3>
                            <p class="text-sm text-gray-600">Mentor: {{ $course->mentor->full_name ?? 'N/A' }}</p>
                        </div>
                    </div>

                    {{-- Course Info --}}
                    <div class="text-sm text-gray-700">
                        <p><strong>Contact:</strong> {{ $course->mentor->contact_number}}</p>
                        <p><strong>Address:</strong> {{ $course->mentor->address}}</p>


                    {{-- Average Review --}}
                    @php
        $store = optional($course->mentor)->store;
        $reviews = $store ? $store->mentorReviews : collect();
        $averageRating = $reviews->avg('rating') ?? 0;
                    @endphp

                    @if ($reviews->count())
                        <div class="text-sm text-yellow-400">
                            <strong>Average Rating:</strong> {{ number_format($averageRating, 1) }}/5
                            ({{ $reviews->count() }} review{{ $reviews->count() > 1 ? 's' : '' }})
                        </div>
                    @else
                        <div class="text-sm text-gray-500">No reviews yet.</div>
                    @endif

                    </div>
                </div>
            @endforeach
        @else
            <p class="text-gray-700">You are not enrolled in any mentor’s course.</p>
        @endif
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