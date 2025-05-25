<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Mail\OrderPlacedMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OrderController extends Controller {
    
    use AuthorizesRequests;

    public function __construct() {
        $this->middleware('auth');
    }

    public function displayOrder(Request $request){
        /** @var User $user */
        $user = Auth::user();
        
        $orders = $user->orders()
            ->with('items.product')
            ->latest()
            ->get();

        return view('customer.orders.order', compact('orders'));
    }

    public function showOrder(Order $order){

        $this->authorize('view', $order);
        
        $order->load('items.product', 'payment', 'shipping');
        return view('customer.orders.show', compact('order'));
    }

    public function storeOrder(Request $request){

        $this->authorize('create', Order::class);
    
        /** @var User $user */
        $user = Auth::user();
        $cartItems = $user->cartItems()->with('product')->get();
    
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
    
        foreach ($cartItems as $item) {
            if (!$item->product || is_null($item->product->regular_price)) {
                return redirect()->route('cart.index')->with('error', 'A product is missing its price.');
            }
    
            if ($item->product->stock_quantity < $item->quantity) {
                return redirect()->route('cart.index')->with('error', "Sorry, not enough stock for {$item->product->product_name}.");
            }
        }
        // Calculate subtotal
        $subtotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->regular_price;
        });
    
        $taxRate = 0.02;
        $taxAmount = $subtotal * $taxRate;
        $total = $subtotal + $taxAmount;    

        // Create the order
        $order = $user->orders()->create([
            'total_amount' => $total,
            'payment_status' => 'pending',
            'shipment_status' => 'pending',
            'user_id' => $user->id,
        ]);

        foreach ($cartItems as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->regular_price,
            ]);
        }
        Mail::to($request->user()->email)->send(new OrderPlacedMail($order));
        $user->cartItems()->delete();
        return redirect()->back()->with('success', 'Product checked out successfully.');
    }

    // Combined Shipping and Payment method
    public function createShippingAndPayment(Order $order){

        $this->authorize('update', $order);
        return view('customer.orders.payment', compact('order'));
    }

    public function storeShippingAndPayment(Request $request, Order $order){

        $this->authorize('update', $order);
    
        $validated = $request->validate([
            // Shipping validation
            'shipping_method' => 'required|in:Standard,Express,Overnight',
            'address' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
            'mobile_number' => 'required|string|max:20',
    
            // Payment validation
            'payment_method' => 'required|in:credit_card,paypal,bank_transfer,gcash,COD',
    
            // Credit Card
            'card_number' => 'required_if:payment_method,credit_card|nullable|digits_between:13,19',
            'expiry' => 'required_if:payment_method,credit_card|nullable|date_format:m/y',
            'cvc' => 'required_if:payment_method,credit_card|nullable|digits:3',
    
            // PayPal
            'paypal_email' => 'required_if:payment_method,paypal|nullable|email',
    
            // Bank Transfer
            'account_name' => 'required_if:payment_method,bank_transfer|nullable|string|max:100',
            'bank_name' => 'required_if:payment_method,bank_transfer|nullable|string|max:100',
            'iban' => 'required_if:payment_method,bank_transfer|nullable|string|max:34',
    
            // GCash
            'gcash_name' => 'required_if:payment_method,gcash|nullable|string|max:100',
            'gcash_number' => 'required_if:payment_method,gcash|nullable|digits_between:10,13',
    
            // COD
            'COD' => 'required_if:payment_method,COD|nullable',
        ]);
    
        // Save shipping information
        $order->shipping()->create([
            'full_name' => $validated['full_name'],
            'shipping_method' => $validated['shipping_method'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'zip_code' => $validated['zip_code'],
            'mobile_number' => $validated['mobile_number'] ?? null,
            'shipping_status' => 'processing',
            'tracking_number' => 'UPS' . strtoupper(uniqid())  // Assign tracking number to shipping
        ]);
    
            
        $paymentStatus = ($validated['payment_method'] === 'COD') ? 'processing' : 'completed';

        // Prepare base payment data
        $paymentData = [
            'payment_method' => $validated['payment_method'],
            'payment_status' => $paymentStatus,
            'transaction_id' => 'txn_' . uniqid(),
            'amount' => $order->total_amount,
        ];


        switch ($validated['payment_method']) {
            case 'credit_card':
                $paymentData['card_number'] = $validated['card_number'];
                $paymentData['expiry'] = $validated['expiry'];
                $paymentData['cvc'] = $validated['cvc'];
                break;
            case 'paypal':
                $paymentData['paypal_email'] = $validated['paypal_email'];
                break;
            case 'bank_transfer':
                $paymentData['account_name'] = $validated['account_name'];
                $paymentData['bank_name'] = $validated['bank_name'];
                $paymentData['iban'] = $validated['iban'];
                break;
            case 'gcash':
                $paymentData['gcash_name'] = $validated['gcash_name'];
                $paymentData['gcash_number'] = $validated['gcash_number'];
                break;
            case 'COD':
                $paymentData['COD'] = $validated['COD'];
                break;
        }

        // Save payment info
        $order->payment()->create($paymentData);

        // Update order status accordingly
        $order->update([
            'payment_status' => $paymentStatus,
            'shipment_status' => 'processing',
            'status' => 'processing',
        ]);

        foreach ($order->items as $item) {
            $product = $item->product;
        
            if ($product && is_numeric($item->quantity) && $item->quantity > 0) {
                $product->decrement('stock_quantity', (int)$item->quantity);
        
                // Check and update stock status
                if ($product->stock_quantity <= 0) {
                    $product->stock_status = 'Out of Stock';
                    $product->save();
                }
            }
        }
        return redirect('customer.orders.history')->with('success', 'asdasd.');
    }
    
    public function yourorder(Order $order){
        // Use eager loading to prevent N+1 queries
        $order->load('items.product', 'shipping', 'payment');
        return view('customer.orders.showorder', [
            'order' => $order
        ]);
    }

    public function pendingorder(){

         /** @var User $user */
         $user = Auth::user();
        
         $orders = $user->orders()
             ->with('items.product')
             ->latest()
             ->get();
 
        return view('customer.orders.history', compact('orders'));
    }


    public function cancelOrder(Order $order){
        $this->authorize('update', $order);
    
        $shipmentStatus = strtolower(trim($order->shipment_status));
        $paymentStatus = strtolower(trim($order->payment_status));
    
        $blockedShipmentStatuses = ['processing'];
        $blockedPaymentStatuses = ['completed', 'refunded'];
    
        if (in_array($shipmentStatus, $blockedShipmentStatuses) || in_array($paymentStatus, $blockedPaymentStatuses)) {
            return redirect()->back()->with('error', 'Order cannot be cancelled due to its current shipment or payment status.');
        }
    
        $order->update([
            'status' => 'cancelled',
            'shipment_status' => 'cancelled',
            'payment_status' => 'cancelled',
        ]);
    
        return redirect()->back()->with('success', 'Order has been cancelled.');
    }
}
