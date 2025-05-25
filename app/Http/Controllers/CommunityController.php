<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function index()
    {

        $totalMessages = Message::count();


        $messages = Message::with(['sender', 'receiver'])->latest()->paginate(20);
        return view('community.index', compact('messages', 'totalMessages'));
    }
}
