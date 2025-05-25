@extends('customer.layouts.layout')

@section('title_customer')
    ConnectingNotes
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

@section('customer_layout')
    <div>

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
        <center>
            <h1 class="text-3xl font-bold mb-4 text-black">My Certificates</h1>
        </center>
        <hr class="my-4 border-black animate-fade-in-up">
        <div class="container">

            @if($certificates->count())
                <ul class="list-group">
                    @foreach($certificates as $certificate)
                        <li class="list-group-item">
                            Issued to: <strong>{{ $certificate->name }}</strong> — Certificate: <strong>{{ $certificate->event }}</strong> — Issued by: <strong>{{ $certificate->instructor }}</strong> — Certificate No.: <strong>{{ $certificate->certificate_no }}</strong> — Date Issued: <strong>{{ $certificate->created_at->format('F d, Y') }}</strong>
                            <a href="{{route('certificates.student', $certificate->student_id)}}" 
                                class="btn btn-sm btn-primary float-end">View</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-black">No certificates found.</p>
            @endif  </div>

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

   