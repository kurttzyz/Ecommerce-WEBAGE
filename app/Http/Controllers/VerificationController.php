<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function form(Request $request)
    {
        $email = session('email');

        $user = User::where('email', $email)->first();
    
    
        return view('auth.verify', compact('user'));
    }
    
    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'verification_code' => 'required',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user || $user->verification_code !== $request->verification_code) {
            return back()->withErrors(['verification_code' => 'Invalid verification code']);
        }
    
        $user->email_verified_at = now();
        $user->verification_code = null;
        $user->save();
    
        auth()->login($user); // auto login
    
        if ($user->role == 1) { // mentor
            return redirect()->route('seller.seller-form')->with('success', 'Email verified! Please complete your mentor profile.');
        }
    
        if ($user->role == 2) { // student
            Auth::logout();
            return redirect()->route('login')->with('success', 'Email verified!');
        }
    
        // If user role is neither mentor nor student, logout and redirect login (optional)
        auth()->logout();
        return redirect()->route('login')->withErrors(['role' => 'Unauthorized user role.']);
    }
    
    
}
