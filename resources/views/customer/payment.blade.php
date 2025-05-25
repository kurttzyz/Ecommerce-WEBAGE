@extends('customer.layouts.layout')
@section('title_customer')
ConnectingNotes
@endsection
@section('customer_layout')
    <center><h1 style="color:white">Your Payments</h1></center>
     <hr class="my-4 border-green-500 animate-fade-in-up">
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

