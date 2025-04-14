<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\PayMongoService;

class PaymentAPI extends Controller {
    public function checkout(PayMongoService $payMongo){

        $paymentIntent = $payMongo->createPaymentIntent(500); // e.g., ₱500
        // Show client the next step (e.g., QR Code or redirect URL)
        dd($paymentIntent);
    }

    public function showCheckoutForm(){
        return view('customer.checkout.checkout'); // Blade file
    }

    public function processCheckout(Request $request, PayMongoService $payMongo){
        
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        // Create GCash payment method
        $paymentMethod = $payMongo->createGcashPaymentMethod([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);

        // Create payment intent
        $paymentIntent = $payMongo->createPaymentIntent(500); // ₱500

        // Attach payment method to intent
        $attached = $payMongo->attachPaymentMethod(
            $paymentIntent['data']['id'],
            $paymentMethod['data']['id']
        );

        // Check and redirect to GCash authorization
        if (isset($attached['data']['attributes']['next_action']['redirect']['url'])) {
            $redirectUrl = $attached['data']['attributes']['next_action']['redirect']['url'];
            return redirect($redirectUrl);
        } else {
            return back()->with('error', 'Payment could not be processed. Please try again.');
        }
    }
}
