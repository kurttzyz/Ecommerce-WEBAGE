@extends('admin.layouts.layout')
@section('title_admin', 'User Profile')

@section('admin_layout')
    <div class="mt-2">
        <a href="{{ route('admin.users') }}"
            class="px-2 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
            ← Back to User List
        </a>
    </div>
    <br>
        <div class="max-w-4xl mx-auto p-4 bg-white dark:bg-neutral-900 rounded shadow">


            <div class="flex flex-col items-center">
                <img class="w-32 h-32 rounded-full object-cover mb-4 border-4 border-blue-500"
                    src="{{ asset('storage/' . Auth::user()->profile_photo) }}" 
                    alt="Profile Picture">

                <h2 class="text-2xl font-semibold text-gray-800 dark:text-black">{{ $users->full_name }}</h2>
                <p class="text-gray-500 dark:text-gray-600">{{ $users->email }}</p>
                <p class="text-gray-500 dark:text-gray-600">{{ $users->address }}</p>
                <p class="text-gray-500 dark:text-gray-600">{{ $users->contact_number }}</p>

                <span
                    class="mt-2 inline-block px-3 py-1 text-sm bg-blue-100 text-blue-800 rounded dark:bg-blue-900 dark:text-blue-200">
                    {{ $users->role == 0 ? 'Admin/Secretary' : ($users->role == 2 ? 'Student' : 'Mentor') }}
                </span>
            </div>





            @if($users->role == 1 && $users->sellers->isNotEmpty())
                <div class="mt-8">
                    <center><h3 class="text-xl font-semibold text-gray-800 dark:text-black mb-4">Submitted Documents</h3></center>
                    <ul class="list-disc list-inside space-y-2">
                        @foreach($users->sellers as $document)
                        <center>
                            <li>
                                <p>Curriculum Vitae:</p>
                                <a href="{{ asset('storage/' . $document->business_certificate) }}" target="_blank"
                                    class="text-blue-600 hover:underline">
                                    {{ $document->business_certificate ?? basename($document->business_certificate) }}
                                </a>

                                <p>Music Plan:</p>
                                <a href="{{ asset('storage/' . $document->music_plan) }}" target="_blank"
                                    class="text-blue-600 hover:underline">
                                    {{ $document->music_plan ?? basename($document->music_plan) }}
                                </a>

                                <p>Government ID:</p>
                                <a href="{{ asset('storage/' . $document->government_id) }}" target="_blank" class="text-blue-600 hover:underline">
                                    {{ $document->government_id ?? basename($document->government_id) }}
                                </a>
                            </li>
                        </center>
                        @endforeach
                    </ul>
                </div>
            @elseif($users->role == 1)
                <div class="mt-8 text-gray-500 dark:text-gray-400">
                    <p>This mentor has not submitted any documents yet.</p>
                </div>
            @endif


        </div>
@endsection