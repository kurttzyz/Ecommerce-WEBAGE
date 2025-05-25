@extends('seller.layouts.layout')
@section('title_seller')
    ConnectingNotes
@endsection
@section('seller_layout')
    <center><h1 class="text-white">Your Revenue</h1></center>
    <hr class="my-4 border-green-500 animate-fade-in-up">
    <center><h2 class="text-white">Total Revenue: ₱{{ number_format($grossRevenue , 2) }}</h2></center>

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


