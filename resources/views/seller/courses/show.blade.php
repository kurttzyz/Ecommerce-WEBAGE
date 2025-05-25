@extends('seller.layouts.layout')

@section('title_seller')
    {{ $course->title }} - ConnectingNotes
@endsection

@section('seller_layout')

    <div><a href="{{ url()->previous() }}"
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
    s


                                                                                        <div class="max-w-4xl mx-auto">
                                                                                            <center>

                                                                                                <div class="bg-white rounded shadow p-6 mb-6">
                                                                                                    <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $course->title }}</h1>
                                                                                                    <p class="text-gray-600 mb-6">{{ $course->description }}</p>

                                                                                                    <h2 class="text-xl font-semibold text-gray-700 mb-4">Course Details</h2>
                                                                                                    <ul class="list-disc pl-6 text-gray-600 mb-6">
                                                                                                        <li><strong>Created at:</strong> {{ $course->created_at->format('F j, Y') }}</li>
                                                                                                        <strong>Instructor:</strong> {{ $course->mentor->full_name ?? 'N/A' }}   
                                                                                                        <li><strong>Enrolled Students:</strong> {{ $studentCount }}/20</li>
                                                                                                    </ul>




                                                                                                    <div class="mt-4">
                                                                                                        <h2 style="color:black">ANNOUNCEMENTS</h2>
                                                                                                        @foreach($course->announcements()->latest()->get() as $announcement)
                                                                                                            <div class="relative bg-gray-100 p-4 rounded-lg shadow mb-4">
                                                                                                                <!-- Delete Button -->
                                                                                                                <form action="{{ route('announcement.destroy', $announcement->id) }}" method="POST" class="absolute top-2 right-2">
                                                                                                                    @csrf
                                                                                                                    @method('DELETE')
                                                                                                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this announcement?')"
                                                                                                                        class="text-red-500 hover:text-red-700 font-bold text-lg">&times;</button>
                                                                                                                </form>

                                                                                                                <h3 class="text-lg font-semibold text-gray-800">{{ $announcement->title }}</h3>
                                                                                                                <p class="text-gray-700">{{ $announcement->body }}</p>
                                                                                                                <small class="text-gray-500">Posted: {{ $announcement->created_at->format('F j, Y') }}</small>

                                                                                                                <!-- Responses -->
                                                                                                                <div class="mt-4">
                                                                                                                    <h4 class="text-lg font-semibold text-gray-700">Responses:</h4>
                                                                                                                    @foreach($announcement->responses as $response)
                                                                                                                        <div class="mt-2 p-3 bg-gray-200 rounded-lg">
                                                                                                                            <p class="font-semibold text-black">{{ $response->mentor->full_name ?? 'User' }}</p>
                                                                                                                            <p class="text-gray-700">{{ $response->response }}</p>
                                                                                                                            <small class="text-gray-500">{{ $response->created_at->format('F j, Y \a\t g:i A') }}</small>
                                                                                                                        </div>
                                                                                                                    @endforeach
                                                                                                                </div>

                                                                                                                <!-- Response Form -->
                                                                                                                <div class="mt-4 bg-gray-50 p-4 rounded-lg shadow">
                                                                                                                    <h4 class="text-lg font-semibold text-gray-700">Respond to this Announcement</h4>
                                                                                                                    <form action="{{ route('announcements.responds', $announcement->id) }}" method="POST">
                                                                                                                        @csrf
                                                                                                                        <div class="mb-2">
                                                                                                                            <textarea name="response" id="response" rows="4"
                                                                                                                                class="w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-black"
                                                                                                                                placeholder="Enter your response" required></textarea>
                                                                                                                        </div>
                                                                                                                        <div class="flex justify-center">
                                                                                                                            <button type="submit" class="bg-blue text-black">
                                                                                                                                Submit Response
                                                                                                                            </button>
                                                                                                                        </div>
                                                                                                                    </form>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        @endforeach


                                                                                                    <div class="flex justify-between mb-4">
                                                                                                        <a href="{{ route('activity.create', $course->id) }}"
                                                                                                            class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-blue-500 transition duration-300">
                                                                                                            Add Activity
                                                                                                        </a>
                                                                                                        <a href="{{ route('announcement.create', $course->id) }}"
                                                                                                            class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-blue-500 transition duration-300">
                                                                                                            Add Announcements
                                                                                                        </a>
                                                                                                    </div>

                                                                                                </div>
                                                                                            </center>

                                                                                            <div class="bg-white rounded shadow p-6 mb-6">
                                                                                                <center>
                                                                                                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Attendance Records</h2>
                                                                                                </center>


                                                                                                {{-- Attendance Records Table --}}
                                                                                                @php
    $dates = $course->attendances->pluck('date')->unique()->sort();
                                                                                                @endphp

                                                                                                @forelse($dates as $date)
                                                                                                    <div class="mb-6">
                                                                                                        <h3 class="text-xl font-semibold text-gray-700 mb-2">
                                                                                                            {{ \Carbon\Carbon::parse($date)->format('F j, Y') }}
                                                                                                        </h3>
                                                                                                        <table class="w-full table-auto border border-gray-300 mb-4">
                                                                                                            <thead class="bg-gray-200">
                                                                                                                <tr>
                                                                                                                    <th class="border px-4 py-2 text-left text-black">Student</th>
                                                                                                                    <th class="border px-4 py-2 text-left text-black">Status</th>
                                                                                                                </tr>
                                                                                                            </thead>
                                                                                                            <tbody>
                                                                                                                @foreach($course->attendances->where('date', $date) as $attendance)
                                                                                                                    <tr>
                                                                                                                        <td class="border px-4 py-2 text-black">{{ $attendance->student->full_name ?? 'N/A' }}</td>
                                                                                                                        <td class="border px-4 py-2 capitalize text-black">{{ $attendance->status }}</td>
                                                                                                                    </tr>
                                                                                                                @endforeach
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </div>
                                                                                                @empty
                                                                                                    <p class="text-gray-500 text-center">No attendance records yet.</p>
                                                                                                @endforelse


                                                                                                {{-- Add Activity and Attendance Buttons --}}
                                                                                                <div class="flex justify-center mb-6">
                                                                                                    <a href="{{ route('add.attendance', $course->id) }}"
                                                                                                        class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-blue-500 transition duration-300">
                                                                                                        Mark Attendance
                                                                                                    </a>



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