@extends('customer.layouts.layout')

@section('title_customer')
    ConnectingNotes
@endsection

@section('customer_layout')
    <div class="container mx-auto p-6 space-y-10 bg-white min-h-screen">

      

        <!-- Store Card -->
        <div class="bg-gray-900 rounded-2xl shadow-lg overflow-hidden border border-green-800 animate-fade-in-up">

            <!-- Store Header -->
            <div class="bg-blue-600 from-blue-600 to-blue-800 p-6 text-white rounded-t-2xl  ">
                <h2 class="text-4xl font-bold">{{ $viewstores->store_name }}</h2>
                <p class="text-sm opacity-90">{{ $viewstores->slug }}</p>
            </div>

            <!-- Store Body -->
            <div class="bg-white p-6 space-y-6 animate-fade-in">
                <!-- Store Details -->
                <div>
                    <h3 class="text-xl font-bold text-black mb-2">About the Mentor</h3>
                    <p class="text-black leading-relaxed">{{ $viewstores->details }}</p>
                </div>

                <!-- Store Design Section -->
                <div>
                    <center>
                        <h1 class="text-2xl font-bold mb-4 text-black">Available Courses</h1>
                    </center>
                    <hr class="my-4 border-green-500 animate-fade-in-up">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                        @foreach ($courses as $course)
                            <div class="bg-gray-200 rounded-lg shadow p-4">
                                <h2 class="text-xl font-semibold">{{ $course->title }}</h2>
                                <p style="color:black">{{ $course->description }}</p>

                                @foreach ($course->sessions as $session)
                                    <div class="mt-4">
                                        <h3 class="text-lg font-semibold text-black">{{ $session->title }}</h3>
                                        <p style="color:black">{{ $session->description }}</p>

                                        @php
                                            $visitedCheckoutSessions = session('checkout_sessions', []);
                                        @endphp

                                        @if (!in_array($session->id, $enrolledSessionIds))
                                            @if (in_array($session->id, $visitedCheckoutSessions))
                                                <!-- Show Enroll Button Only -->
                                                <form method="POST" action="{{ route('sessions.enroll', ['id' => $session->id]) }}"
                                                    class="mt-2">
                                                    @csrf
                                                    <button type="submit"
                                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                                        Enroll
                                                    </button>
                                                </form>
                                            @else
                                                <!-- Show Pay & Enroll Button -->
                                                <a href="{{ route('customer.checkout.form', ['session_id' => $session->id]) }}"
                                                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                                    Pay & Enroll
                                                </a>
                                            @endif
                                        @else
                                            <span class="text-green-600 font-medium">Already Enrolled</span>
                                            <hr style="color:black">
                                        @endif

                                    </div>
                                @endforeach

                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Review Section -->
                @if(count($enrolledSessionIds) > 0)
                    <h3 class="text-2xl font-bold text-black mb-4">Leave a Review</h3>

                    <form method="POST" action="{{ route('student.review', ['store' => $viewstores->id]) }}">
                        @csrf
                        <div class="mb-4">
                            <label for="rating" class="block text-black font-medium mb-2">Rating (1 to 5):</label>
                            <select id="rating" name="rating"
                                class="w-full p-2 rounded bg-white text-black border border-red-600">
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="comment" class="block text-black font-medium mb-2">Comment:</label>
                            <textarea id="comment" name="comment" rows="4"
                                class="w-full p-2 rounded bg-white text-black border border-red-600"></textarea>
                        </div>

                        <center>
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded">Submit
                                Review</button>
                        </center>
                    </form>
                @endif

                @if ($reviews->count())
                    <div class="mt-8">
                        <h4 class="text-xl text-black font-semibold mb-4">What others are saying:</h4>
                        <div class="space-y-4">
                            @foreach ($reviews as $review)
                                <center>
                                    <div class="bg-gray-200 p-4 rounded-lg border border-red-700">

                                        <p class="text-yellow-500 text-4xl">
                                            {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                                        </p>
                                        <p class="text-black font-semibold text-xl">{{ $review->user->full_name }}</p>
                                        <p class="text-black text-xl">{{ $review->comment }}</p>
                                        <p class="text-gray-500 text-sm">{{ $review->created_at->diffForHumans() }}</p>
                                    </div>
                                </center>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>

    <!-- Custom Animations -->
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
            animation: fadeIn 0.8s ease-out both;
        }

        .animate-fade-in {
            animation: fadeIn 1.2s ease-out both;
        }
    </style>
@endsection

<!-- JavaScript to handle visibility toggle -->
<script>
    function handlePayEnroll(sessionId, checkoutUrl) {
        // Hide the Pay & Enroll button
        document.getElementById('payEnrollBtn-' + sessionId).style.display = 'none';

        // Show the Enroll form
        document.getElementById('enrollForm-' + sessionId).classList.remove('hidden');

        // Redirect to checkout
        window.location.href = checkoutUrl;
    }
</script>