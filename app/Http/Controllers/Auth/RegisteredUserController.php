<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\VerifyEmailCode;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'address' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'role' => ['required', 'in:1,2'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $verificationCode = Str::random(6); // or use mt_rand(100000, 999999)

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'address' => $request->address,
            'contact_number' => $request->contact_number,
            'role' => $request->role,    
            'password' => Hash::make($request->password),
            'verification_code' => $verificationCode,
        ]);

          // Send code via email
        Mail::to($user->email)->send(new VerifyEmailCode($user));

        event(new Registered($user));
        session(['email' => $user->email]);
        
        return redirect()->route('verification.form')->with('email', $user->email);
    }
}