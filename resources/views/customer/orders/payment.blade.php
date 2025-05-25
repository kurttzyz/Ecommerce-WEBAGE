@extends('customer.layouts.layout')

@section('title_customer')
    ConnectingNotes
@endsection

@section('customer_layout')
<center><h1 class="text-white">Shipping and Payment for Order #{{ $order->id }}</h1></center>
   
    

<div class="container mx-auto p-6 text-black bg-white fade-in">  

  
    
    <form method="POST" action="{{ route('orders.shipping_payment', ['order' => $order->id]) }}">
        @csrf
        @method('POST')
        <!-- Shipping Information -->
        <div class="mb-6">
            <h2 class="text-lg text-black font-semibold mb-4">Shipping Information</h2>

            <div class="mb-4">
                <label for="shipping_method" class="text-black block text-gray-700">Shipping Method</label>
                <select name="shipping_method" id="shipping_method" class="text-black w-full px-4 py-2 border rounded-md" required>
                    <option value="Standard">Standard</option>
                    <option value="Express">Express</option>
                    <option value="Overnight">Overnight</option>
                </select>
            </div>

            <div class="mb-4 text-white" >
                <label for="full_name" class="block text-black">Full Name</label>
                <input type="text" name="full_name" id="full_name" class="text-black w-full px-4 py-2 border rounded-md" placeholder="e.g(Dela Cruz, Juan c.)" required>
            </div>

            <div class="mb-4 text-white" >
                <label for="address" class="block text-black">Address</label>
                <input type="text" name="address" id="address" class="text-black w-full px-4 py-2 border rounded-md" required>
            </div>

            <div class="mb-4 text-white">
                <label for="city" class="block text-black">City</label>
                <input type="text" name="city" id="city" class="text-black w-full px-4 py-2 border rounded-md" required>
            </div>

            <div class="mb-4 text-white">
                <label for="zip_code" class="block text-black">Zip Code</label>
                <input type="number" name="zip_code" id="zip_code" class="text-black w-full px-4 py-2 border rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="mobile_number" class="block text-black">Mobile #</label>
                <input type="number" name="mobile_number" id="mobile_number" class="text-black w-full px-4 py-2 border rounded-md" required>
            </div>
        </div>

        <!-- Payment Information -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-4 text-black">Payment Information</h2>

            <div class="mb-4">
                <label for="payment_method" class="text-black block text-white-700">Payment Method</label>
                <select name="payment_method" id="payment_method" class="text-black w-full px-4 py-2 border rounded-md"  onchange="togglePaymentFields()" required>
                    <option value="">Select a method</option>
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="bank_transfer">Bank Transfer</option>
                    <option value="gcash">GCash</option>
                    <option value="COD">Cash on Delivery</option> <!-- ✅ New -->
                </select>
                
                
            </div>

            <!-- Credit Card Fields -->
            <div id="credit_card_fields" class="hidden">
                <div class="mb-4">
                    <label for="card_number" class="text-black block black-gray-700">Card Number</label>
                    <input type="text" name="card_number" id="card_number" class="text-black w-full px-4 py-2 border rounded-md">
                </div>

                <div class="mb-4">
                    <label for="expiry" class="text-black block text-gray-700">Expiry Date</label>
                    <input type="text" name="expiry" id="expiry" class="text-black w-full px-4 py-2 border rounded-md">
                </div>

                <div class="mb-4">
                    <label for="cvc" class="text-black block text-gray-700">CVC</label>
                    <input type="text" name="cvc" id="cvc" class="text-black w-full px-4 py-2 border rounded-md">
                </div>
            </div>

            <!-- PayPal Fields -->
            <div id="paypal_fields" class="hidden">
                <div class="mb-4">
                    <label for="paypal_email" class="text-black block text-gray-700">PayPal Email</label>
                    <input type="email" name="paypal_email" id="paypal_email" class="text-black w-full px-4 py-2 border rounded-md">
                </div>
            </div>

            <!-- Bank Transfer Fields -->
            <div id="bank_transfer_fields" class="hidden">
                <div class="mb-4">
                    <label for="account_name" class="text-black block text-gray-700">Account Name</label>
                    <input type="text" name="account_name" id="account_name" class="text-black w-full px-4 py-2 border rounded-md">
                </div>

                <div class="mb-4">
                    <label for="bank_name" class="text-black block text-gray-700">Bank Name</label>
                    <input type="text" name="bank_name" id="bank_name" class="text-black w-full px-4 py-2 border rounded-md">
                </div>

                <div class="mb-4">
                    <label for="iban" class="text-black block text-gray-700">IBAN</label>
                    <input type="text" name="iban" id="iban" class="text-black w-full px-4 py-2 border rounded-md">
                </div>
            </div>

   
                <!-- GCash Fields -->
            <div id="gcash_fields" class="hidden">
                <div class="mb-4">
                    <label for="gcash_name" class="text-black block text-gray-700">GCash Account Name</label>
                    <input type="text" name="gcash_name" id="gcash_name" value="Kurt Martin" class="text-black w-full px-4 py-2 border rounded-md">
                </div>

                <div class="mb-4">
                    <label for="gcash_number" class="text-black block text-gray-700">GCash Mobile Number</label>
                    <input type="text" name="gcash_number" id="gcash_number" value="09610310072" class="text-black w-full px-4 py-2 border rounded-md">
                </div>

                            <!-- COD Fields -->
                <div id="cod_fields">
                        <div class="mb-4">
                            <p class="text-black">You will pay in cash upon delivery. Please ensure someone is available to receive and pay for the package.</p>
                            <input type="text" name="COD" id="COD" value="COD" class="text-black w-full px-4 py-2 border rounded-md">
                            </div>
                </div>
                            

        </div>

        <!-- Submit Button -->
        <center>
        <div class="mt-4">
            
                <button type="submit" class="text-white bg-green-500 hover:bg-black text-white  text-black px-4 py-2 rounded-md">
                    Confirm Membership and Complete Payment
                </button>
            
        </div>
        </center>
    </form>
</div>

<script>
    function togglePaymentFields() {
        const paymentMethod = document.getElementById('payment_method').value;
        
        // Hide all payment fields initially
        const paymentFields = ['credit_card_fields', 'paypal_fields', 'bank_transfer_fields', 'gcash_fields', 'cod_fields'];
        paymentFields.forEach(field => {
            const element = document.getElementById(field);
            element.classList.add('hidden');
            element.classList.remove('show');
        });
        
        // Show specific payment fields based on selected method
        if (paymentMethod === 'credit_card') {
            const creditCardFields = document.getElementById('credit_card_fields');
            creditCardFields.classList.remove('hidden');
            creditCardFields.classList.add('fade-in', 'show');
        } else if (paymentMethod === 'paypal') {
            const paypalFields = document.getElementById('paypal_fields');
            paypalFields.classList.remove('hidden');
            paypalFields.classList.add('fade-in', 'show');
        } else if (paymentMethod === 'bank_transfer') {
            const bankTransferFields = document.getElementById('bank_transfer_fields');
            bankTransferFields.classList.remove('hidden');
            bankTransferFields.classList.add('fade-in', 'show');
        } else if (paymentMethod === 'gcash') {
            const gcashFields = document.getElementById('gcash_fields');
            gcashFields.classList.remove('hidden');
            gcashFields.classList.add('fade-in', 'show');
        } else if (paymentMethod === 'cod') {
            const codFields = document.getElementById('cod_fields');
            codFields.classList.remove('hidden');
            codFields.classList.add('fade-in', 'show');
        }
    }
</script>


<!-- Tailwind CSS hidden class fallback for Blade -->
<style>
    .hidden {
        display: none;
    }
</style>
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
