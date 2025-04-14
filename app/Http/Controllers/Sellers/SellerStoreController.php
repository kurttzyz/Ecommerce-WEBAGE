<?php
namespace App\Http\Controllers\Sellers;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SellerStoreController extends Controller {
    public function index (){
        $user_id = Auth::user()->id;
        $stores = Store::where('user_id', $user_id)->get();
        return view('seller.store.create', compact('stores'));
    }

    public function manage (){
        $user_id = Auth::user()->id;
        $stores = Store::where('user_id', $user_id)->get();
        return view('seller.store.manage', compact('stores'));
    }

    public function store(Request $request){
        $validate_data = $request->validate([
            'store_name'=> 'unique:stores|max:100|min:3',
            'slug'=> 'required|unique:stores',
            'details'=> 'required',
        ]);

        Store::create([
            'store_name'=>$request->store_name,
            'slug'=>$request->slug,
            'details'=>$request->details,
            'user_id'=>Auth::user()->id,
        ]);

        return redirect()->back()->with('success', 'Store Created Successfully!');
    }

    public function editstore(Request $request, $id){
        $store = Store::findOrFail($id);
        return view('seller.store.edit', compact('store'));
    }

    public function updatestore(Request $request, $id){
        $Store = Store::findOrFail($id);
        $validate_data = $request->validate([
            'store_name' => 'required|string|max:100|min:3',
            'slug' => 'required|string|unique:stores,slug,'.$id,
            'details' => 'required|string|min:3|max:100',
        ]);

        $Store->update($validate_data);
        return redirect()->back()->with('success','Store Updated Successfully!');
    }

    public function deletestore($id){
        Store::findOrFail($id)->delete();

        return redirect()->back()->with('success','Store Deleted Successfully!');
    }

}
