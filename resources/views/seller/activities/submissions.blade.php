@extends('seller.layouts.layout')

@section('title_seller')
    ConnectingNotes
@endsection

@section('seller_layout')
    <h1 class="text-2xl font-bold mb-4">Submissions for: {{ $activity->title }}</h1>

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

    @if ($activity->submissions->count())
        <table class="w-full table-auto border">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Student</th>
                    <th class="border px-4 py-2">Content</th>
                    <th class="border px-4 py-2">Attachment</th>
                    <th class="border px-4 py-2">Submitted At</th>
                    <th class="border px-4 py-2">Grade</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($activity->submissions as $submission)
                    <tr>
                        <td class="border px-4 py-2">{{ $submission->student->name }}</td>
                        <td class="border px-4 py-2">{{ $submission->content }}</td>
                        <td class="border px-4 py-2">
                            @if ($submission->attachment)
                                <a href="{{ Storage::url($submission->attachment) }}" target="_blank"
                                    class="text-blue-600 underline">Download</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="border px-4 py-2">{{ $submission->submitted_at }}</td>
                        <td class="border px-4 py-2">
                            {{ $submission->grade ?? 'Not graded' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No submissions yet.</p>
    @endif
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