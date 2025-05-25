<?php
namespace App\Http\Controllers\Sellers;
use App\Models\Store;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellerProductController extends Controller {
    public function index(){
        $authuser_id = Auth::id();
        $stores = Store::where('user_id', $authuser_id)->get();
        return view('seller.product.create', compact('stores'));
    }

    public function manage(){
        $currentseller = Auth::id();
        $products = Product::where('seller_id', $currentseller)
                            ->with('images') // Eager load images
                            ->get();
        
        return view('seller.product.manage', compact('products'));
    }
    
    public function editproduct(Request $request, $id){
        
        $product = Product::findOrFail($id);
        $authUserId = Auth::id();
        // Get only the stores owned by the authenticated seller
        $stores = Store::where('user_id', $authUserId)->get();
        return view('seller.product.edit', compact('product', 'stores'));
    }
    
    public function updateproduct(Request $request, $id){
        
        $product = Product::findOrFail($id);
        // Validate request
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'required|string|max:255',
            'regular_price' => 'required|numeric',
            'discounted_price' => 'nullable|numeric',
            'tax_rate' => 'nullable|numeric',
            'stock_quantity' => 'nullable|integer|min:0',
            'slug' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Update product details
        $product->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'sku' => $request->sku,
            'regular_price' => $request->regular_price,
            'discounted_price' => $request->discounted_price,
            'tax_rate' => $request->tax_rate,
            'stock_quantity' => $request->stock_quantity,
            'slug' => $request->slug,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);
    
        // Automatically update stock_status based on new stock quantity
        if ($product->stock_quantity <= 0) {
            $product->stock_status = 'Out of Stock';
        } else {
            $product->stock_status = 'In Stock';
        }
        $product->save();
    
        // Handle Image Upload (if new images are uploaded)
        if ($request->hasFile('images')) {
            $oldImages = ProductImage::where('product_id', $product->id)->get();
            foreach ($oldImages as $oldImage) {
                Storage::disk('public')->delete($oldImage->img_path);
                $oldImage->delete();
            }
    
            $firstImage = true;
            foreach ($request->file('images') as $file) {
                $path = $file->store('product_images', 'public');
    
                ProductImage::create([
                    'product_id' => $product->id,
                    'img_path' => $path,
                    'is_primary' => $firstImage,
                ]);
    
                $firstImage = false;
            }
        }
        return redirect()->back()->with('success', 'Course Updated Successfully!');
    }
    
    public function deleteproduct($id){
        Product::findOrFail($id)->delete();

        return redirect()->back()->with('success','Course Deleted Successfully!');
    }

    public function storeproduct(Request $request){

        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'required|string|unique:products,sku',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id', // Fixed validation
            'store_id' => 'required|exists:stores,id',
            'regular_price' => 'required|numeric|min:0',
            'discounted_price' => 'nullable|numeric|min:0',
            'tax_rate' => 'required|numeric|min:0|max:100',
            'stock_quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create the product and store it in a variable
        $product = Product::create([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'sku' => $request->sku,
            'seller_id' => Auth::id(),
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id, // Fixed key
            'store_id' => $request->store_id,
            'regular_price' => $request->regular_price,
            'discounted_price' => $request->discounted_price,
            'tax_rate' => $request->tax_rate,
            'stock_quantity' => $request->stock_quantity,
            'slug' => $request->slug,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);

        // Handle image upload
        if ($request->hasFile('images')) {
            $firstImage = true; // Set first uploaded image as primary
            foreach ($request->file('images') as $file) {
                $path = $file->store('product_images', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'img_path' => $path,
                    'is_primary' => $firstImage, // First image is primary
                ]);
                $firstImage = false;
            }
        }
        return redirect()->back()->with('success', 'Course Added Successfully!');
    }
}
