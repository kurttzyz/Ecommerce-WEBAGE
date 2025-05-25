@extends('customer.layouts.layout')

@section('title_customer')
    ConnectingNotes
@endsection

@section('customer_layout')
<center><h1 class="text-white">Order #{{ $order->id }} Details</h1></center>

<div class="animate-fade-in-up">
    <a href="{{ url()->previous() }}"
       class="inline-flex items-center text-green-400 hover:text-green-300 transition duration-200 mb-4">
        <!-- Heroicon: Arrow Left -->
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
        Back
    </a>
  </div>



<div class="text-black bg-black container mx-auto p-6 fade-in">
    @foreach($order->items as $item)
    <div class="mb-6 flex flex-col bg-black border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
        <img class="w-full h-auto rounded-t-xl" src="{{ asset('storage/' . $item->product->images->first()->img_path) }}" alt="Product Image">
        <div class="p-4 md:p-5">
            <center><h3 class="text-lg font-bold text-gray-800 dark:text-white">Course/Services</h3></center>
            <center><p class="text-white">{{ $item->product->product_name }} - ₱ {{ number_format($item->price, 2) }} x {{ $item->quantity }}</p></center>
        </div>
    </div>
    @endforeach

    <div class="mt-6 p-4 bg-white text-black rounded-xl shadow border dark:border-neutral-700">
        <center>
            <h3 class="text-black text-lg font-bold text-gray-800 dark:text-white">
                Payment Status: 
                <span class="order-status bg-white" data-status="{{$order->payment_status}}">
                    <span class="status-icon"></span>
                    <span class="status-text">{{ $order->payment_status }}</span>
                </span>
            </h3>
        </center>

        <center> 
            <h3 class="text-black text-lg font-bold text-gray-800 dark:text-white">
                Membership Status: 
                <span class="order-status bg-white" data-status="{{$order->shipment_status}}">
                    <span class="status-icon"></span>
                    <span class="status-text">{{ $order->shipment_status }}</span>
                </span>
            </h3>
        </center>

        <div class="mt-4">
            @if($order->status == 'pending')
            <center>
                <form action="{{ route('orders.createshippingpayment', $order) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded-md hover:bg-black focus:outline-none focus:ring-2 focus:ring-blue-300">
                        Confirm Order
                    </button>
                </form>
            </center>
            @elseif($order->status == 'processing')
            <center>
                <a href="{{ route('orders.showorder', $order) }}" class="bg-green-500 text-white px-6 py-3 rounded-md hover:bg-black focus:outline-none focus:ring-2 focus:ring-yellow-300">
                    Membership Details
                </a>
            </center>
            @endif
        </div>
    </div>
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const orderStatuses = document.querySelectorAll('.order-status');

        orderStatuses.forEach(function(statusElement) {
            const status = statusElement.getAttribute('data-status').toLowerCase();
            const iconElement = statusElement.querySelector('.status-icon');
            const textElement = statusElement.querySelector('.status-text');

            // Reset
            statusElement.style.padding = "5px 10px";
            statusElement.style.borderRadius = "8px";
            statusElement.style.display = "inline-flex";
            statusElement.style.alignItems = "center";
            iconElement.style.marginRight = "8px";

            // Handle different statuses
            switch (status) {
                case 'pending':
                    iconElement.innerHTML = '<i class="fas fa-clock fa-spin"></i>';
                    iconElement.classList.add('text-yellow-500');
                    textElement.classList.add('text-yellow-500', 'font-bold');
                    statusElement.style.backgroundColor = '#fff3cd';
                    statusElement.style.borderLeft = '5px solid yellow';
                    break;

                case 'processing':
                    iconElement.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                    iconElement.classList.add('text-blue-500');
                    textElement.classList.add('text-blue-500', 'font-bold');
                    statusElement.style.backgroundColor = '#dbeafe';
                    statusElement.style.borderLeft = '5px solid #3b82f6';
                    break;

                case 'completed':
                    iconElement.innerHTML = '<i class="fas fa-check-circle"></i>';
                    iconElement.classList.add('text-green-500');
                    textElement.classList.add('text-green-500', 'font-bold');
                    statusElement.style.backgroundColor = '#d1fae5';
                    statusElement.style.borderLeft = '5px solid green';
                    break;

                case 'failed':
                    iconElement.innerHTML = '<i class="fas fa-times-circle"></i>';
                    iconElement.classList.add('text-red-500');
                    textElement.classList.add('text-red-500', 'font-bold');
                    statusElement.style.backgroundColor = '#fee2e2';
                    statusElement.style.borderLeft = '5px solid red';
                    break;

                case 'cancelled':
                    iconElement.innerHTML = '<i class="fas fa-ban"></i>';
                    iconElement.classList.add('text-gray-500');
                    textElement.classList.add('text-gray-500', 'font-bold');
                    statusElement.style.backgroundColor = '#e5e7eb';
                    statusElement.style.borderLeft = '5px solid gray';
                    break;
            }
        });
    });
</script>

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