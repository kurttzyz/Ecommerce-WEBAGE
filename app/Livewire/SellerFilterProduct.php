<?php
namespace App\Livewire;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;

class SellerFilterProduct extends Component {
  
    public $categories;
    public $selectedCategory = '';
    public $products = [];

    public function mount(){
        $this->categories = Category::all();
        $this->products = Product::all();
    }

    public function updatedSelectedCategory($value){

        $this->products = $value
            ? Product::where('category_id', $value)->get()
            : Product::all();
    }
    public function render(){
        return view('livewire.seller-filter-product');
    }
}
