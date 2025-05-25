<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\PayMongoService;
use Illuminate\Support\Facades\Http;

class PaymentAPI extends Controller {
    public function checkout(PayMongoService $payMongo, Request $request){

        $sessionId = $request->session_id;  // Accept session_id as a parameter

        $paymentIntent = $payMongo->createPaymentIntent(5000, [
            'success' => route('customer.checkout.success'),
            'failed' => route('customer.checkout.failure')
        ]);
        

        session(['session_id' => $sessionId]);
        // Show client the next step (e.g., QR Code or redirect URL)
        dd($paymentIntent);
    }

    public function showCheckoutForm($session_id)
    {
        // Get existing visited checkout sessions from session
        $checkoutSessions = session()->get('checkout_sessions', []);
    
        // Add the current session_id if it's not already in the list
        if (!in_array($session_id, $checkoutSessions)) {
            $checkoutSessions[] = $session_id;
            session()->put('checkout_sessions', $checkoutSessions);
        }
    
        return view('customer.checkout.checkout', compact('session_id'));
    }
    

    public function processCheckout(Request $request, PayMongoService $payMongo)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        // Create the GCash payment method
        $paymentMethod = $payMongo->createGcashPaymentMethod([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);

        // Create the payment intent
        $paymentIntent = $payMongo->createPaymentIntent(5000);
        

        // Attach the payment method to the payment intent
        $attached = $payMongo->attachPaymentMethod(
            $paymentIntent['data']['id'],
            $paymentMethod['data']['id']
        );

        // Check if payment was successfully processed
        if (isset($attached['data']['attributes']['next_action']['redirect']['url'])) {
            $redirectUrl = $attached['data']['attributes']['next_action']['redirect']['url'];
            
            // Save the redirect URL in the session so we can come back to this after redirect
            session(['redirect_url' => $redirectUrl]);

            // Redirect to the payment page (e.g., GCash)
            return redirect($redirectUrl);
        } else {
            return back()->with('error', 'Payment could not be processed. Please try again.');
        }
    }

    public function paymentSuccess(Request $request)
    {
        $sessionId = session('session_id'); // Retrieve the session_id from session
        $user = auth()->user();
    
        // Check if the user is already enrolled in the session to avoid duplicate enrollments
        $alreadyEnrolled = $user->sessions()->where('session_id', $sessionId)->exists();
    
        if (!$alreadyEnrolled) {
            // Enroll the student by associating them with the session
            $user->sessions()->attach($sessionId); // This will enroll the student
        }
    
        // Prepare the data to be sent to the POST route
        $enrollmentData = [
            'session_id' => $sessionId,
            'user_id' => $user->id, // You can add any other relevant data
        ];
    
        // Redirect to the POST route with the data
        return redirect()->route('sessions.enroll')->with($enrollmentData);
    }
    

    public function paymentFailed(Request $request)
{
    return redirect()->route('customer.store.view')->with('error', 'Payment failed or was cancelled. Please try again.');
}


    public function createPaymentIntent($amount, $redirect = [])
    {
        $payload = [
            'data' => [
                'attributes' => [
                    'amount' => $amount,
                    'payment_method_allowed' => ['gcash'],
                    'payment_method_options' => [
                        'gcash' => [
                            'redirect' => [
                                'success' => $redirect['success'] ?? url('customer.checkout.success'),
                                'failed' => $redirect['failed'] ?? url('customer.checkout.failure'),
                            ]
                        ]
                    ],
                    'currency' => 'PHP',
                ]
            ]
        ];

        $secretKey = env('PAYMONGO_SECRET_KEY');

        $response = Http::withBasicAuth($secretKey, '')
            ->withHeaders([
                'Content-Type' => 'application/json',
            ])
            ->post('https://api.paymongo.com/v1/payment_intents', $payload);

        return $response->json();
    }

    
}
