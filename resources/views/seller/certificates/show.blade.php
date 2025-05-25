@extends('seller.layouts.layout')

@section('title_seller')
    ConnectingNotes - Certificate
@endsection

@section('seller_cart')

    <div>
        <a href="{{ url()->previous() }}"
            class="inline-flex items-center text-black hover:text-blue transition duration-200 mb-4">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Back
        </a>
    </div>

    <div
        class="max-w-4xl mx-auto my-12 border border-gray-300 rounded-xl shadow-xl p-10 text-center relative animate-fade-in-up bg-[#F9E8E2] print:bg-white">

        <!-- Centered Logo -->
        <div class="flex justify-center mb-2">
            <img src="{{ asset('landingpage/img/notes.png') }}" alt="Logo" style="width: 90px; height: 90px;"
                class="object-contain">
        </div>

        <!-- School Info -->
        <h2 class="text-sm font-semibold text-red-700">Herliz Music School</h2>
        <h3 class="text-lg font-medium text-gray-800 mb-4">MUSIC SCHOOL LESSON COMPLETION</h3>

        <!-- Certificate Title -->
        <h1 class="text-6xl md:text-8xl lg:text-9xl font-bold text-red-600 tracking-widest my-4">C E R T I F I C A T E</h1>

        <!-- Presented To -->
        <p class="text-gray-700 text-lg mb-2">This Certificate is Presented to</p>
        <div class="text-2xl font-bold text-red-600 border-b-2 border-gray-500 inline-block px-6 py-1 mb-6">
            {{ $certificate->name }}
        </div>

        <!-- Description -->
        <p class="text-gray-800 text-lg leading-relaxed mb-6 max-w-2xl mx-auto">
            In Recognition of Completing Lessons.<br>
            They have successfully mastered skills, showcasing remarkable growth and talent.
        </p>

        <!-- Awarded Date -->
        <p class="text-gray-700 text-lg mb-1">Awarded on</p>
        <div class="text-base font-semibold border-b-2 border-gray-500 inline-block px-4 py-1 mb-10 text-black">
            {{ \Carbon\Carbon::parse($certificate->date)->format('F j, Y') }}
        </div>

        <!-- Signatures -->
        <div class="flex justify-between items-end mt-12 px-10 print:flex-col print:gap-10">
            <!-- Left Signature -->
            <div class="flex flex-col items-center relative w-48 h-16">
                <!-- Signature Image as Background -->
                <img src="{{ asset('landingpage/img/sign.png') }}" alt="Owner Signature"
                    class="absolute inset-0 w-full h-full object-contain opacity-30 z-0">

                <!-- Owner Name -->
                <p class="text-base font-semibold text-black relative z-10">
                    {{ $certificate->owner ?? 'Herliz Owner' }}
                </p>

                <!-- Underline and Label -->
                <div class="border-b border-black w-full mt-1 mb-1 z-10 relative"></div>
                <p class="text-sm text-black relative z-10">Owner</p>
            </div>


            <!-- Right Signature -->
            <div class="flex flex-col items-center">
                <p class="text-base font-semibold text-black">{{ $certificate->instructor ?? 'Mentor Name' }}</p>
                <div class="border-b border-black w-48 mb-1"></div>
                <p class="text-sm text-black">Mentor</p>
            </div>
        </div>


        <!-- Certificate Number -->
        <p class="mt-10 text-sm text-gray-500">Certificate No: {{ $certificate->certificate_no }}</p>

        <!-- Print Button -->
        <div class="mt-8">
            <button onclick="window.print()"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded print:hidden mb-4">
                Print Certificate
            </button>
        </div>
    </div>

@endsection

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
            animation: fadeIn 1s ease-out forwards;
        }

        @media print {
            body * {
                visibility: hidden;
            }

            .max-w-4xl,
            .max-w-4xl * {
                visibility: visible;
            }

            .max-w-4xl {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                padding: 0;
            }

            button {
                display: none !important;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush