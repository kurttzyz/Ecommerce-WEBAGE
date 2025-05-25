<?php

namespace App\Http\Controllers\Sellers;

use App\Models\SellerForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;


class SellerApplicationController extends Controller{

    public function seller_form (){
        return view('seller.become_seller.form');
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'business_name' => 'required|string',
            'country' => 'required|string',
            'business_address' => 'required|string',
            'payment_method' => 'required',
            'business_certificate' => 'required|file',
            'music_plan' => 'required|file',
            'government_id' => 'required|file',
            'agree_terms' => 'accepted',
            'confirm_info' => 'accepted',
        ]);
    
        $certificate = $request->file('business_certificate')->store('documents', 'public');
        $id = $request->file('government_id')->store('documents', 'public');
        $music_plan = $request->file('music_plan')->store('documents', 'public');
       
        SellerForm::create([
            'user_id' => Auth::id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'business_name' => $request->business_name,
            'country' => $request->country,
            'business_address' => $request->business_address,
            'payment_method' => $request->payment_method,
            'business_certificate' => $certificate,
            'music_plan' => $music_plan,
            'government_id' => $id,
            
        ]);
    
        Auth::logout(); // Log out the user directly

        return redirect()->route('login')->with('success', 'Submitted successfully and logged out!');

    }



   
}
