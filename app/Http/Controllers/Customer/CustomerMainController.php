<?php
namespace App\Http\Controllers\Customer;
use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\HomePageSetting;
use App\Http\Controllers\Controller;


class CustomerMainController extends Controller {
    public function index(Request $request){
        $homepagesetting = HomePageSetting::with([
            'discountedProduct.images',
            'featuredProduct1.images',
            'featuredProduct2.images',
        ])->first();

        $products = Product::all();

        return view('customer.dashboard', compact('homepagesetting', 'products'));
    }

    
    public function search(Request $request){
        
        $query = $request->input('query');

        // Search for products by name (case-insensitive search)
        $products = Product::where('product_name', 'LIKE', '%' . $query . '%')->get();
        return view('customer.search.product', compact('products', 'query'));
    }

    public function showstore($slug){
        $viewstores = Store::where('slug', $slug)->firstOrFail();
        return view('customer.store.showstore', compact('viewstores'));
    }

    public function viewstore (){
        $stores = Store::all();
        return view('customer.store.viewstore', compact('stores'));
    }

    public function viewproduct ($product_name){
        $product = Product::where('product_name', $product_name)->firstOrFail();
        return view('customer.category.viewproduct', compact('product'));
    }

    public function showcategoryproduct($category_name){
        // Find the category by its name, not by ID
        $category = Category::where('category_name', $category_name)->firstOrFail();
        // Get products that belong to the category
        $product = Product::where('category_id', $category->id)->get();
        return view('customer.category.showproduct', compact('category', 'product'));
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
}
