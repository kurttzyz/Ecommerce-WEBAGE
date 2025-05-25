<?php
namespace App\Http\Controllers\Sellers;
use DB;
use App\Models\Order;
use App\Models\Store;
use App\Models\Course;
use App\Models\Product;
use App\Models\Revenue;
use App\Models\Category;
use App\Models\MentorReview;
use Illuminate\Http\Request;
use App\Models\MentorSession;
use App\Models\HomePageSetting;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellerMainController extends Controller {


    public function index()
    {
        $mentor = auth()->user();

        // Total number of courses created by the mentor
        $totalSessions = Course::where('mentor_id', $mentor->id)->count();

        // Get all sessions under the mentor's courses
        $sessionIds = MentorSession::whereHas('course', function ($query) use ($mentor) {
            $query->where('mentor_id', $mentor->id);
        })->pluck('id');

        // Get unique student IDs enrolled in those sessions
        $totalStudents = \DB::table('session_enrollments')
            ->whereIn('session_id', $sessionIds)
            ->distinct('student_id')
            ->count('student_id');

        return view('seller.dashboard', compact('totalSessions', 'totalStudents'));
    }


    public function search(Request $request){
        $query = $request->input('query');
 
        $products = Product::where('product_name', 'LIKE', '%' . $query . '%')->get();
        return view('seller.search.product', compact('products', 'query'));
    }

    public function showstore($slug){
        $user = Auth::user();
        $viewstores = Store::where('slug', $slug)->firstOrFail();
        $courses = $viewstores->mentorCourses()->with('sessions')->get();
        $sessions = MentorSession::all();
        $reviews = MentorReview::where('store_id', $viewstores->id)->with('user')->latest()->get();
        $enrolledSessionIds = $user->mentorSessions()->pluck('mentor_sessions.id')->toArray();
        
        return view('seller.store.showstore', compact('viewstores', 'courses', 'sessions', 'enrolledSessionIds', 'reviews'));
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

    public function sellerRevenue() {
        $seller = Auth::user(); 
        $grossRevenue = 0;
    
        foreach ($seller->products as $product) {
            $productRevenue = $product->orderItems()
                ->whereHas('order', function ($query) {
                    $query->where('payment_status', 'completed');
                })
                ->sum(DB::raw('quantity * price'));
    
            $grossRevenue += $productRevenue;
        }
    
        $platformFee = $grossRevenue * 0.20;
        $netRevenue = $grossRevenue - $platformFee;
    
        // Save into a revenue table (create this model and migration if not yet)
        Revenue::updateOrCreate(
            ['seller_id' => $seller->id],
            [
                'gross_revenue' => $grossRevenue,
                'platform_fee' => $platformFee,
                'net_revenue' => $netRevenue,
            ]
        );
    
        return view('seller.payments', compact('grossRevenue', 'platformFee', 'netRevenue'));
    }
    

    public function history (){
        return view('seller.orders.history');
    }

     public function submitReview(Request $request, $storeId)
    {
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|max:1000',
    ]);

    MentorReview::create([
        'user_id' => auth()->id(),
        'store_id' => $storeId,
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);

    return back()->with('success', 'Review submitted successfully!');
    }


    
    public function upload(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile_photos', 'public');

            // Delete old photo if it exists
            if (Auth::user()->profile_photo) {
                Storage::disk('public')->delete(Auth::user()->profile_photo);
            }

            Auth::user()->update(['profile_photo' => $path]);

            return response()->json([
                'message' => 'Profile updated successfully.',
                'image_url' => asset('storage/' . $path),
            ]);
        }

        return response()->json(['message' => 'No file uploaded.'], 422);
    }


    public function contract(){
        return view('seller.contract');
    }



    public function policy(){
        return view('seller.policy');
    }

}
