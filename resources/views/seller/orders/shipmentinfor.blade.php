@extends('seller.layouts.layout')

@section('title_seller')
    ConnectingNotes
@endsection

@section('seller_layout')
<center><h1>Order #{{ $order->id }} Details</h1></center>

<div class="text-black container mx-auto p-6">
    <div class="bg-white shadow-lg p-4 rounded-lg">
        <h3 class="text-lg text-black font-semibold">Products</h3>
        <ul>
            @foreach($order->items as $item)
                <li>
                    <p>{{ $item->product->product_name }} - ₱ {{ number_format($item->price, 2) }} x {{ $item->quantity }}</p>
                </li>
            @endforeach
        </ul>

        <h3 class="mt-4 font-semibold">Payment Status</h3>
        <p>{{ $order->payment_status }}</p>

        <h3 class="mt-4 font-semibold">Membership Status</h3>
        <p>{{ $order->shipment_status }}</p>

    </div>
</div>
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
