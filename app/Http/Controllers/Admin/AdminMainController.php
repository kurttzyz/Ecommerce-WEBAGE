<?php
namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\HomePageSetting;
use App\Http\Controllers\Controller;

class AdminMainController extends Controller {
    public function index(Request $request){

        $role = $request->get('role');
        $usersQuery = User::query();
    
        if ($role === '1') {
            $usersQuery->where('role', 1);
        } elseif ($role === '2') {
            $usersQuery->where('role', 2);
        }
        $users = $usersQuery->get();
    
        // Count data
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 0)->count();
        $totalSellers = User::where('role', 1)->count();
        $totalCustomers = User::where('role', 2)->count(); 
        return view('admin.admin', compact('totalSellers', 'totalUsers', 'totalAdmins', 'totalCustomers'));
    }

    public function setting(){
        $products = Product::all();
        $homepagesetting = HomePageSetting::first() ?? new HomepageSetting();
        return view('admin.setting', compact('products', 'homepagesetting'));
    }

    public function updatehomepagesetting(Request $request){
        $request->validate([
        'discounted_product_id' => 'required|exists:products,id',
        'discounted_amount' => 'required|numeric|min:1',
        'discount_heading' => 'required|string|max:255',
        'discount_subheading' => 'required|string|max:255',
        'featured_product_1_id' => 'nullable|exists:products,id',
        'featured_product_2_id' => 'nullable|exists:products,id',
        ]);

        $homepagesetting = HomePageSetting::first() ?? new HomepageSetting();
        $homepagesetting->fill($request->all());
        $homepagesetting->save();

        return redirect()->route('admin.settings')->with('success', 'Homepagesetting Updated Successfully!');
    }

    public function destroy ($id){
        $user = User::findOrFail($id);
          // Prevent deletion if user is an admin or has role 0
        if ($user->role === 0) {
            return redirect()->back()->with('error', 'Cannot delete an Admin user.');
        }
        $user->delete();
        return redirect()->back()->with('success', 'User Deleted Successfully!');
    }
    
    public function manage_user($role = null){

        if (in_array($role, ['1', '2'])) {
            $users = User::where('role', $role)->get();
        } else {
            $users = User::all();
        }
    
        return view('admin.manage.user', compact('users', 'role'));
    }
    
    public function manage_revenues(){
        return view('admin.manage.revenues');
    }

    public function manage_stores(){
        return view('admin.manage.store');
    }

    public function cart_history(){
        return view('admin.cart.history');
    }

    public function order_history(){
        return view('admin.order.history');
    }

}
