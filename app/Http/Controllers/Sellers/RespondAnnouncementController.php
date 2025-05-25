<?php

namespace App\Http\Controllers\Sellers;

use App\Models\Response;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RespondAnnouncementController extends Controller
{
    public function respond(Request $request, Announcement $announcement)
    {
        // Validate the response
        $request->validate([
            'response' => 'required|string',
        ]);

        // Save the response (for example, you might create a Response model)
        $response = new Response();
        $response->announcement_id = $announcement->id;
        $response->user_id = auth()->id();
        $response->response = $request->response;
        $response->save();

  


        return back()->with('success', 'Your response has been submitted.', );
    }
}
