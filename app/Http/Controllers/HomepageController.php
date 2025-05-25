<?php
namespace App\Http\Controllers;
use Inertia\Inertia;
use App\Models\HomePageSetting;
use Illuminate\Support\Facades\Auth;


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

    public function welcome(){
        return view('welcome');
    }

    public function policy (){
        return view('policy');
    }

    public function contract(){
        return view('contract');
    }


}
