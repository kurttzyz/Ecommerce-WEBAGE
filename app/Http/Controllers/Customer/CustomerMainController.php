<?php
namespace App\Http\Controllers\Customer;
use Inertia\Inertia;
use App\Models\Store;
use App\Models\Course;
use App\Models\Product;
use App\Models\Category;
use App\Models\Announcement;
use App\Models\MentorReview;
use Illuminate\Http\Request;
use App\Models\MentorSession;
use App\Models\HomePageSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class CustomerMainController extends Controller {
    public function index(Request $request)
    {
        $user = Auth::user();
        $studentSessions = $user->mentorSessions()->with('course.mentor', 'course.mentor.store.mentorReviews')->get();
        $courses = $studentSessions->pluck('course')->unique('id');

        return view('customer.dashboard', compact('courses'));
    }



  public function showClassroom($course_id)

    {
        $course = MentorSession::with(['course.mentor', 'students', 'course.announcements', 'course.activities', 'course.announcements.responses.student'])->findOrFail($course_id);
        $courses = Course::where('mentor_id', Auth::id())->get();
        $respond = Announcement::with('responses.student')->get();
        $content = Course::all();

        return view('customer.class.show', compact('course', 'content', 'courses'));
    }


    public function show(Course $course)
    {
        $course->load('mentor');

        return view('customer.class.show', compact('course'));
    }


    
    public function search(Request $request){
        
        $query = $request->input('query');

        // Search for products by name (case-insensitive search)
        $products = Product::where('product_name', 'LIKE', '%' . $query . '%')->get();
        return view('customer.search.product', compact('products', 'query'));
    }

    public function showstore($slug){
        $user = Auth::user();
        $viewstores = Store::where('slug', $slug)->firstOrFail();
        $courses = $viewstores->mentorCourses()->with('sessions')->get();
        $sessions = MentorSession::all();
        $reviews = MentorReview::where('store_id', $viewstores->id)->with('user')->latest()->get();
        $enrolledSessionIds = $user->mentorSessions()->pluck('mentor_sessions.id')->toArray();

        return view('customer.store.showstore', compact('viewstores', 'courses', 'sessions', 'enrolledSessionIds', 'reviews'));
    }

    public function viewstore (){
        $stores = Store::all();
        return view('customer.store.viewstore', compact('stores'))->render();
       
    }

    public function viewproduct ($product_name){
        $product = Product::where('product_name', $product_name)->firstOrFail();
        return view('customer.category.viewproduct', compact('product'));
    }

    public function showcategoryproduct($category_name){
        $category = Category::where('category_name', $category_name)->firstOrFail();
        $product = Product::where('category_id', $category->id)->get();

        return view('customer.category.showproduct', compact('category', 'product'));
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


    public function history () {
        return view ('customer.history');
    }

    public function payment () {
        return view ('customer.payment');
    }

    public function affiliates () {
        return view ('customer.affiliates');
    }

    public function edit () {
        return view ('dashboard');
    }


    public function home () {
        return Inertia::render('Home',[
            'user' => Auth::user()->name,
            'title' => 'Welcome to my site',

        ]);
    }


    public function seller_form (){
        return view ('customer.become_seller.form');
    }


    public function class() {
        $user = Auth::user();
        $courses = $user->mentorSessions; // from a relationship in the User model


        return view('customer.class.index', compact('courses'));
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



}
