<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $currentUser = $request->user();
    
        $messages = Message::where('sender_id', $currentUser->id)
            ->orWhere('receiver_id', $currentUser->id)
            ->orderBy('created_at', 'desc')
            ->get();


            
    
        // Fetch all other users for the dropdown/select
        $users = \App\Models\User::where('id', '!=', $currentUser->id)->get();
    
        return view('messages.index', compact('messages', 'users'));
    }
    

    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        $message = Message::create([
            'sender_id' => $request->user()->id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Message sent!');
    }
}
