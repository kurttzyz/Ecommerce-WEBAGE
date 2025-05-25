@extends('seller.layouts.layout')

@section('title_seller')
    ConnectingNotes | View Session
@endsection

@section('seller_layout')

        <div>
            <h1 class="text-2xl font-bold">{{ $course->title }}</h1>
            <p class="text-gray-600">{{ $course->description }}</p>

            <div class="flex justify-between items-center mt-6">
                <h2 class="text-xl font-semibold">Sessions</h2>
                <a href="{{ route('mentor.courses.sessions.create', $course->id) }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded">+ Add Session</a>
            </div>

            @if ($course->sessions->count())
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($course->sessions as $session)
                        <div class="bg-white shadow p-4 rounded">
                            <h3 class="font-bold">{{ $session->title }}</h3>
                            <p class="text-sm text-gray-500">Scheduled: {{ $session->schedule->format('F j, Y h:i A') }}</p>
                            <a href="#" class="text-blue-600 mt-2 inline-block">Manage</a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600 mt-4">No sessions added yet.</p>
            @endif
        </div>


        <div class="mt-8">
            <div class="flex justify-between items-center">
                <h2 class="text-lg fon-bold">Activities</h2>
                <a href="{{ route('mentor.activities.create', $session->id) }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded">+ Add Activity</a>
            </div>

            @if ($session->activities->count())
                <ul class="mt-4 space-y-2">
                    @foreach ($session->activities as $activity)
                        <li class="border rounded p-3">
                            <strong>{{ $activity->title }}</strong><br>
                            <span class="text-sm text-gray-500">Due:
                                {{ $activity->due_date ? $activity->due_date->format('F j, Y h:i A') : 'No deadline' }}</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-600 mt-2">No activities added yet.</p>
            @endif
        </div>

@endsection