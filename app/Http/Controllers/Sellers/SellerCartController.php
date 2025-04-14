<?php
namespace App\Http\Controllers\Sellers;
use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SellerCartController extends Controller {
   
    public function index(){
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->with('items.product')->first();

        return view('seller.carts.cart', compact('cart'));
    }

    public function add(Product $product){
        
        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        $item = CartItem::where('cart_id', $cart->id)
                        ->where('product_id', $product->id)
                        ->first();

        if ($item) {
            $item->quantity += 1;
            $item->save();
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }
        return redirect()->back()->with('success', 'The Product Added To Cart Successfully!');
    }

    public function remove($itemId){

        $item = CartItem::findOrFail($itemId);
        if ($item->cart->user_id === Auth::id()) {
            $item->delete();
        }
        return redirect()->back()->with('success', 'Item removed from cart.');
    }


    public function increaseQuantity(CartItem $item){
        $item->quantity += 1;
        $item->save();

        return back();
    }

    public function decreaseQuantity(CartItem $item){

        if ($item->quantity > 1) {
            $item->quantity -= 1;
            $item->save();
        } else {
            $item->delete(); // remove if it hits 0
        }
        return back();
    }

    public function removeItem(CartItem $item){
        $item->delete();

        return back()->with('success', 'Item removed from cart.');
    }
}
