@section('title', 'All Messages')

<x-app-layout>
    <div class="container mx-auto max-w-3xl p-4 flex-direction-column">
        <h1 class="text-2xl font-bold mb-4">All Messages</h1>

        @if($messages->isEmpty())
            <p class="text-gray-600">No messages yet.</p>
        @else
            <ul class="space-y-4">
                @foreach ($messages as $message)
                    <li class="border border-gray-200 p-4 rounded shadow-sm bg-white">
                        <div class="mb-1 text-sm text-gray-500 flex items-center space-x-2">
                            {{-- Sender --}}
                            <img src="{{ $message->sender->profile_picture ?? 'https://ui-avatars.com/api/?name=' . urlencode($message->sender->full_name) }}"
                                alt="Sender Avatar" class="w-8 h-8 rounded-full object-cover border border-gray-300">
                            <div>
                                <strong>{{ $message->sender->full_name }}</strong>
                                ({{ getRoleLabel($message->sender->role) }})
                                to
                            </div>

                            {{-- Receiver --}}
                            <img src="{{ $message->receiver->profile_picture ?? 'https://ui-avatars.com/api/?name=' . urlencode($message->receiver->full_name) }}"
                                alt="Receiver Avatar" class="w-8 h-8 rounded-full object-cover border border-gray-300 ml-2">
                            <div>
                                <strong>{{ $message->receiver->full_name }}</strong>
                                ({{ getRoleLabel($message->receiver->role) }})
                            </div>

                            <span class="ml-auto text-xs text-gray-400">
                                {{ $message->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <p class="text-gray-800 mt-2">{{ $message->message }}</p>
                    </li>
                @endforeach
            </ul>

            <div class="mt-4">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
</x-app-layout>