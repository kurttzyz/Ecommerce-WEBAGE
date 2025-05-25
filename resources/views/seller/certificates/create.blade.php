@extends('seller.layouts.layout')

@section('title_seller')
    ConnectingNotes
@endsection

@section('seller_cart')

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

    <div class="max-w-xl mx-auto p-6 bg-white shadow-md rounded-xl">
        <center><h2 class="text-2xl font-semibold mb-6">Issue a Music Certificate & Achievements</h2></center>
       
        <form action="{{ route('certificates.generate') }}" method="POST" class="space-y-6">
            @csrf

       <div>
        <div><label for="session_id" class="block font-semibold mb-2 text-black">Select Session</label>
        <select class="form-control text-black" name="session_id" id="session_id" required>
            <option value="" disabled selected>Select a Session</option>
            @foreach($sessions as $session)
                <option value="{{ $session->session_id }}">
                    {{ $session->session_title }} - {{ $session->student_name }}
                </option>
            @endforeach
        </select>
        @error('session_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        </div>



                @error('session_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror  </div>   

                <div id="students-dropdown" style="display:none;">
                    <label for="student_id" class="block font-semibold mb-2 text-black">Select Student</label>
                    <select name="student_id" required
                        class="text-black w-full border p-2 rounded focus:ring-2 focus:ring-blue-500 @error('student_id') border-red-500 @enderror">
                        <option value="" disabled selected>Select a student</option>
                    </select>
                    @error('student_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>


            <div>
                <label for="event" class="block font-semibold mb-2 text-black">Event Name</label>
                <input type="text" name="event" value="{{ old('event') }}"
                    class="text-black w-full border p-2 rounded focus:ring-2 focus:ring-blue-500 @error('event') border-red-500 @enderror"
                    placeholder="e.g., Music Bootcamp 2025" required>
                @error('event')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="date" class="block font-semibold mb-2 text-black">Date</label>
                <input type="date" name="date" value="{{ old('date') }}"
                    class="text-black w-full border p-2 rounded focus:ring-2 focus:ring-blue-500 @error('date') border-red-500 @enderror"
                    required>
                @error('date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="instructor" class="block font-semibold mb-2 text-black">Instructor</label>
                <input type="text" name="instructor" value="{{ old('instructor') }}"
                    class="text-black w-full border p-2 rounded focus:ring-2 focus:ring-blue-500 @error('instructor') border-red-500 @enderror"
                    placeholder="Instructor Name" required>
                @error('instructor')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 w-full">Generate
                Certificates</button>
         </form>
    </div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
    @keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    .animate-fade-in-up {
        animation: fadeIn 1s ease-out forwards;
    }
</style>

<script>
    $(document).ready(function () {
        $('#session_id').on('change', function () {
            const sessionId = this.value;

            if (sessionId) {
                $('#students-dropdown').show();

                const sessions = @json($sessions);
                const session = sessions.find(s => s.session_id == sessionId);

                const studentSelect = $('[name="student_id"]');
                studentSelect.empty().append('<option value="" disabled selected>Select a student</option>');

                if (session) {
                    const option = $('<option></option>').val(session.student_id).text(session.student_name);
                    studentSelect.append(option);
                }
            } else {
                $('#students-dropdown').hide();
            }
        });
    });
</script>