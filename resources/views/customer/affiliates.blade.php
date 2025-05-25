@extends('customer.layouts.layout')
@section('title_customer')
    ConnectingNotes
@endsection
@section('customer_layout')
<h1>Your Affiliates</h1>
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

