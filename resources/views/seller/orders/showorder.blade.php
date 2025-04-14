@extends('seller.layouts.layout')

@section('title_seller')
WebAge - Order Details
@endsection

@section('seller_layout')

<div class="max-w-xl mx-auto bg-white shadow-xl rounded-2xl p-6 space-y-6 mb-10">
    
    <!-- Header -->
    <center><h2 class="text-2xl font-bold text-gray-800">Order Summary</h2></center>

    <!-- Shipment Info -->
    <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
        <h3 class="text-lg font-semibold text-gray-700 mb-2">Shipment Details</h3>
        <p class="text-sm text-black">Full Name: <strong>{{ $order->shipping->full_name }}</strong></p>
        <p class="text-sm text-black">Shipment Method: <strong>{{ $order->shipping->shipping_method }}, {{ $order->payment->payment_method }}</strong></p>
        <p class="text-sm text-black">Address: <strong>{{ $order->shipping->address }}, {{ $order->shipping->city }}, {{ $order->shipping->zip_code }}</strong></p>
        <p class="text-sm text-black">Contact Number: <strong>{{ $order->shipping->mobile_number }}</strong></p>
        <p class="text-sm text-black">Tracking Number: <strong>{{ $order->shipping->tracking_number }}</strong></p>
    </div>

    <!-- Product List -->
    <div class="space-y-4">
        <h3 class="text-lg font-semibold text-black">Items</h3>
        @foreach ($order->items as $item)
        <div class="flex items-center justify-between">
            <span class="text-gray-700">{{ $item->product->product_name }}</span>
            <span class="text-gray-900 font-medium">₱{{ number_format($item->price * $item->quantity, 2) }} ({{ $item->quantity }}x)</span>
        </div>
        @endforeach
    </div>

    @php
    $taxRate = 0.02; // 2%
    $tax = $order->total_amount * $taxRate / (1 + $taxRate); 
    $subtotal = $order->total_amount - $tax;
    @endphp

    <!-- Summary Totals -->
    <div class="border-t pt-4 space-y-2">
        <div class="flex justify-between text-sm text-gray-600">
            <span>Subtotal</span>
            <span>₱{{ number_format($subtotal, 2) }}</span>
        </div>
        <div class="flex justify-between text-sm text-gray-600">
            <span>Tax</span>
            <span>₱{{ number_format($tax, 2) }}</span>
        </div>
        <div class="flex justify-between text-lg font-bold text-gray-800 border-t pt-2">
            <span>Total</span>
            <span>₱{{ number_format($order->total_amount, 2) }}</span>
        </div>
    </div>
</div>


@endsection
