<?php
namespace App\Http\Controllers\Sellers;
use App\Models\Order;
use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\HomePageSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class SellerMainController extends Controller {
    public function index (){
        $homepagesetting = HomePageSetting::with([
            'discountedProduct.images',
            'featuredProduct1.images',
            'featuredProduct2.images',
        ])->first();

        $products = Product::all();
        return view('seller.dashboard', compact('homepagesetting', 'products'));
    }

    public function search(Request $request){
        $query = $request->input('query');
        // Search for products by name (case-insensitive search)
        $products = Product::where('product_name', 'LIKE', '%' . $query . '%')->get();
        return view('seller.search.product', compact('products', 'query'));
    }

    public function showstore($slug){
        $viewstores = Store::where('slug', $slug)->firstOrFail();
        return view('seller.store.showstore', compact('viewstores'));
    }

    public function viewstore (){
        $stores = Store::all();
        return view('seller.store.viewstore', compact('stores'));
        
    }

    public function viewproduct ($product_name){
        $product = Product::where('product_name', $product_name)->firstOrFail();
        return view('seller.category.viewproduct', compact('product'));
    }

    public function showcategoryproduct($category_name){
        $category = Category::where('category_name', $category_name)->firstOrFail();
        $product = Product::where('category_id', $category->id)->get();
        return view('seller.category.showproduct', compact('category', 'product'));
    }  

    public function pendingorder(){

        /** @var User $user */
        $user = Auth::user();
       
        $orders = $user->orders()
            ->with('items.product')
            ->latest()
            ->get();

       return view('seller.orders.history', compact('orders'));
    }

    public function cancelOrder(Order $order){
        $this->authorize('update', $order);

        $shipmentStatus = strtolower(trim($order->shipment_status));
        $paymentStatus = strtolower(trim($order->payment_status));

        $blockedShipmentStatuses = ['processing'];
        $blockedPaymentStatuses = ['completed', 'refunded'];

        if (in_array($shipmentStatus, $blockedShipmentStatuses) || in_array($paymentStatus, $blockedPaymentStatuses)) {
            return redirect()->back()->with(
                'error',
                 'Order cannot be cancelled due to its current shipment or payment status.'
            );
        }

            $order->update([
                'status' => 'cancelled',
                'shipment_status' => 'cancelled',
                'payment_status' => 'cancelled',
            ]);
        
        return redirect()->back()->with('success', 'Order has been cancelled.');
    }

    public function yourorder(Order $order){
        // Use eager loading to prevent N+1 queries
        $order->load('items.product', 'shipping', 'payment');
        return view('customer.orders.showorder', [
            'order' => $order
        ]);
    }

    public function sellerRevenue(){
        $seller = Auth::user(); 
        $revenue = 0;

        foreach ($seller->products as $product) {
            $productRevenue = $product->orderItems()
                ->whereHas('order', function ($query) {
                    $query->where('payment_status', 'completed');
                })
                ->sum(DB::raw('quantity * price'));
        
            $revenue += $productRevenue;
        
        }
        return view('seller.payments', compact('revenue'));
    }

    public function history (){
        return view('seller.orders.history');
    }
}
