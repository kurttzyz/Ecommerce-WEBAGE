<?php
namespace App\Http\Controllers\Admin;
use App\Models\Product;
use App\Http\Controllers\Controller;

class ProductDiscountController extends Controller {
    public function index(){
        $products = Product::all();
        return view('admin.discount.create', compact('products'));
    }

    public function manage(){
        return view('admin.discount.manage');
    }
}
