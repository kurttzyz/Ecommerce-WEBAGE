@extends('seller.layouts.layout')

@section('title_seller')
    ConnectingNotes
@endsection

@section('seller_layout')
    <center><h2>All Student Work Submissions</h2></center>
    <hr class="my-4 border-black animate-fade-in-up">
            <div class="bg-white py-4 px-4 max-w-lg mx-auto">
                <ul>
                    @foreach($submissions as $submission)
                        <li>
                            {{ $submission->student->name }}:
                            <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank">View File</a>
                            - {{ $submission->created_at->diffForHumans() }}
                        </li>
                    @endforeach
                </ul>

                <div>
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