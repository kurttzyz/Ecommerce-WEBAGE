@extends('seller.layouts.layout')

@section('title_seller')
    ConnectingNotes - Issued Certificates
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

    <div class="max-w-6xl mx-auto mt-10 p-8 bg-white shadow-xl rounded-xl animate-fade-in-up">
        <center><h2 class="text-3xl font-bold mb-4 text-gray-800">Issued Certificates</h2></center>
        <hr class="my-4 border-black animate-fade-in-up">

        @if($certificates->count())
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border border-gray-200 rounded">
                    <thead class="bg-gray-100 text-sm text-gray-700 uppercase">
                        <tr>
                            <th class="py-3 px-5 border-b">#</th>
                            <th class="py-3 px-5 border-b">Name</th>
                            <th class="py-3 px-5 border-b">Event</th>
                            <th class="py-3 px-5 border-b">Date</th>
                            <th class="py-3 px-5 border-b">Instructor</th>
                            <th class="py-3 px-5 border-b text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-800">
                        @foreach($certificates as $certificate)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-2 px-5 border-b">{{ $loop->iteration }}</td>
                                <td class="py-2 px-5 border-b font-medium">{{ $certificate->name }}</td>
                                <td class="py-2 px-5 border-b">{{ $certificate->event }}</td>
                                <td class="py-2 px-5 border-b">{{ \Carbon\Carbon::parse($certificate->date)->format('M d, Y') }}
                                </td>
                                <td class="py-2 px-5 border-b">{{ $certificate->instructor }}</td>
                                <td class="py-2 px-5 border-b text-center">
                                    <a href="{{ route('certificates.show', $certificate->id) }}"
                                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-1 px-3 rounded transition duration-150">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $certificates->links() }}
            </div>
        @else
            <p class="text-gray-600 mt-6">No certificates found.</p>
        @endif
    </div>

@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush

@push('styles')
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
            animation: fadeIn 0.8s ease-out forwards;
        }
    </style>
@endpush