@extends('admin.layouts.layout')

@section('title_admin')
    ConnectingNotes | Admin
@endsection

@section('admin_layout')


    <div class="container mt-4">
        <div>
            <a href="{{ url()->previous() }}"
                class="inline-flex items-center text-black hover:text-blue transition duration-200 mb-2">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back
            </a>  </div>
        <h2 class="font-bold text-3xl">All Achievements</h2>
 
        @forelse($achievements as $achievement)
            <div class="card mt-4">
                <div class="card-body">
                    <h4 class="card-title">{{ $achievement->title ?? 'No Title' }}</h4>
                    <p><strong>ID:</strong> {{ $achievement->id }}</p>
                    <p><strong>Description:</strong> {{ $achievement->description }}</p>
                    <p><strong>Issued By:</strong> {{ $achievement->issued_by }}</p>
                    <p><strong>Date Issued:</strong> {{ $achievement->created_at->format('F d, Y') }}</p>
                </div>
            </div>

            <h5 class="mt-3">Users who received this achievement</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Progress</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($achievement->users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->full_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->pivot->progress }}%</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No users assigned this achievement.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @empty
            <div class="alert alert-warning mt-4">No achievements found.</div>
        @endforelse
    </div>
@endsection