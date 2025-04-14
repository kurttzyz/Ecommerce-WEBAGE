<?php
namespace App\Http\Controllers;
use App\Models\HomePageSetting;


class HomepageController extends Controller {
    public function index(){
        $homepagesetting = HomePageSetting::with([
            'discountedProduct.images',
            'featuredProduct1.images',
            'featuredProduct2.images',
        ])->first();
        return view('livewire.homepage-component', compact('homepagesetting'));
    }
    public function dashboard(){ 

    return view('dashboard'); 
    }
}
