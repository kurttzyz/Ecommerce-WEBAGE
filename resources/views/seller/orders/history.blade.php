@extends('seller.layouts.layout')

@section('title_seller')
    ConnectingNotes
@endsection

@section('seller_layout')
<center><h1 class="text-white">Your Order History</h1></center>
<hr class="my-4 border-green-500 animate-fade-in-up">
@foreach($orders as $order)
@if(in_array(strtolower($order->payment_status), ['processing', 'cancelled', 'completed']))
<!-- Timeline -->
<div class="fade-in">
    <!-- Item -->
    <div class="flex gap-x-3">
      <!-- Left Content -->
      <div class="min-w-14 text-end">
        <span class="text-xs text-gray-500 dark:text-neutral-400">{{ $order->updated_at->format('F j, Y \a\t h:i A') }}</span>
      </div>
      <!-- End Left Content -->
  
      <!-- Icon -->
      <div class="relative last:after:hidden after:absolute after:top-7 after:bottom-0 after:start-3.5 after:w-px after:-translate-x-[0.5px] after:bg-gray-200 dark:after:bg-neutral-700">
        <div class="relative z-10 size-7 flex justify-center items-center">
          <div class="size-2 rounded-full bg-gray-400 dark:bg-neutral-600"></div>
        </div>
      </div>
      <!-- End Icon -->
  
      <!-- Right Content -->
      <div class="grow pt-0.5 pb-8">
        <h3 class="flex gap-x-1.5 font-semibold text-gray-800 dark:text-white">
          <svg class="shrink-0 size-4 mt-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
            <line x1="16" x2="8" y1="13" y2="13"></line>
            <line x1="16" x2="8" y1="17" y2="17"></line>
            <line x1="10" x2="8" y1="9" y2="9"></line>
          </svg>
          Order Status: 
          <p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">
            <span class="order-status bg-black" data-status="{{ $order->payment_status }}">
                <span class="status-icon"></span>
                <span class="status-text">{{ $order->payment_status }}</span>
            </span>
        </p>
        </h3>
        <h3 class="text-white text-lg font-bold text-gray-800 dark:text-white">
            Shipping Status: 
            <span class="order-status bg-black" data-status="{{$order->shipment_status}}">
              <span class="status-icon"></span>
              <span class="status-text">{{ $order->shipment_status }}</span>
          </span>
          </h3>
          <h3 class="text-white text-lg font-bold text-gray-800 dark:text-white">
              Payment Status: 
              <span class="order-status bg-black" data-status="{{$order->payment_status}}">
                  <span class="status-icon"></span>
                  <span class="status-text">{{ $order->payment_status }}</span>
              </span>
          </h3>
  
          <h3 class="text-white bg-black text-lg font-bold text-gray-800 dark:text-white">
              Sub Total: ₱ {{number_format($order->total_amount, 2)}}
          </h3>
      
          <div class="mt-2 w-full">
              <form action="{{ route('seller.orders.show', $order->id) }}" method="POST">
                  @csrf
                  @method('POST')
                  <button type="submit"
                      class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition duration-300">
                      <i class="fas fa-check-circle"></i>
                      Confirm Your Order
                  </button>
              </form>
          </div>
          
          <div class="mt-1 w-full">
              <form action="{{ route('seller.order.cancel', $order->id) }}" method="POST">
                  @csrf
                  @method('POST')
                  <button type="submit"
                      class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-red-600 hover:bg-black-700 text-white font-semibold rounded-lg shadow-md transition duration-300">
                      <i class="fas fa-times-circle"></i>
                      Cancel Your Order
                  </button>
              </form>
          </div>
        
   
    <!-- End Item -->
</div>
      <!-- End Right Content -->
    </div>
    <!-- End Item -->
  </div>
  <!-- End Timeline -->
  @endif
@endforeach






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


