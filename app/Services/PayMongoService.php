<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class PayMongoService
{
    protected $baseUrl = 'https://api.paymongo.com/v1/';

    public function createPaymentIntent($amount, $currency = 'PHP')
    {
        $amount *= 100; // PayMongo expects centavo format
        $response = Http::withBasicAuth(env('PAYMONGO_SECRET_KEY'), '')
            ->post($this->baseUrl . 'payment_intents', [
                'data' => [
                    'attributes' => [
                        'amount' => $amount,
                        'payment_method_allowed' => ['card', 'gcash', 'paymaya'],
                        'payment_method_options' => [],
                        'currency' => $currency,
                    ]
                ]
            ]);

        return $response->json();
    }

    public function attachPaymentMethod($intentId, $methodId)
    {
        return Http::withBasicAuth(env('PAYMONGO_SECRET_KEY'), '')
            ->post($this->baseUrl . "payment_intents/{$intentId}/attach", [
                'data' => [
                    'attributes' => [
                        'payment_method' => $methodId,
                        'return_url' => route('seller.checkout.success') // 🛑 THIS IS WHAT WAS MISSING
                    ]
                ]
            ])->json();
    }

    public function createGcashPaymentMethod($details)
    {
        return Http::withBasicAuth(env('PAYMONGO_SECRET_KEY'), '')
            ->post($this->baseUrl . 'payment_methods', [
                'data' => [
                    'attributes' => [
                        'type' => 'gcash',
                        'billing' => $details,
                    ]
                ]
            ])->json();
    }
}
