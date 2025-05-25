@section('title')
Send Message
@endsection
<x-app-layout>
    <div class="container mx-auto max-w-3xl p-4">

        <h1 class="text-3xl font-bold mb-8 text-center">Message Someone</h1>

        {{-- Success message --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-8 text-center font-medium">
                {{ session('success') }}
            </div>
        @endif

        {{-- Send Message Form --}}
        <div class="mb-12 bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-6">Send a Message</h2>
            <form action="{{ route('messages.send') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="receiver_id" class="block font-medium mb-2">Select Recipient</label>
                    <select name="receiver_id" id="receiver_id" required
                        class="block w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option disabled selected>-- Choose user to message --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->full_name }} ({{ getRoleLabel($user->role) }})
                            </option>
                        @endforeach
                    </select>
                    @error('receiver_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="message" class="block font-medium mb-2">Message</label>
                    <textarea name="message" id="message" rows="4" required
                        class="block w-full border border-gray-300 rounded px-4 py-2 resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Type your message here...">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700 transition w-full font-semibold">
                        Send Message
                    </button>
                </div>
            </form>
        </div>

        {{-- Messages List --}}
        <div>
           

            <h2 class="text-2xl font-semibold mb-8 text-center ">Your Messages</h2>

            @if($messages->isEmpty())
                <p class="text-gray-600 text-center">No messages yet.</p>
            @else
                <ul class="space-y-12">
                    @foreach ($messages as $message)
                        @if($message->sender_id === Auth::id() || $message->receiver_id === Auth::id())
                            <li class="border border-gray-300 rounded-lg p-6 shadow-md bg-white">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-4">
                                        <img src="{{ $message->sender->profile_picture ?? 'https://ui-avatars.com/api/?name=' . urlencode($message->sender->full_name) }}"
                                            alt="{{ $message->sender->full_name }} profile picture"
                                            class="w-12 h-12 rounded-full object-cover border border-gray-300">
                                        <div>
                                            <p class="font-semibold">From: {{ $message->sender->full_name }}</p>
                                            <p class="text-sm text-gray-500">{{ getRoleLabel($message->sender->role) }}</p>
                                        </div>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $message->created_at->diffForHumans() }}
                                    </div>
                                </div>

                                <div class="flex items-center space-x-4 mb-4">
                                    <img src="{{ $message->receiver->profile_picture ?? 'https://ui-avatars.com/api/?name=' . urlencode($message->receiver->full_name) }}"
                                        alt="{{ $message->receiver->full_name }} profile picture"
                                        class="w-10 h-10 rounded-full object-cover border border-gray-300">
                                    <div>
                                        <p><span class="font-semibold">To:</span> {{ $message->receiver->full_name }}</p>
                                        <p class="text-sm text-gray-500">{{ getRoleLabel($message->receiver->role) }}</p>
                                    </div>
                                </div>

                                <p class="text-gray-800 whitespace-pre-line leading-relaxed">{{ $message->message }}</p>
                            </li>
                        @endif
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-app-layout>