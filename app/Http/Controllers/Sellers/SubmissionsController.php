<?php

namespace App\Http\Controllers\Sellers;

use App\Models\Submission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubmissionsController extends Controller
{

    public function index(){
        $submissions = Submission::all(); // Fetch all data

        return view('seller.submission.index', compact('submissions')); // Pass to view
    }

    public function viewSubmissions($activityId)
    {
        $submissions = Submission::with('student')
            ->where('activity_id', $activityId)
            ->orderBy('submitted_at', 'desc')
            ->get();

        return view('seller.submission.index', compact('submissions'));
    }

   public function submit(Request $request, $grade)
    {
        $request->validate([
            'grade' => 'nullable|string',
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('submissions');
        }

        Submission::create([
            'grade' => $grade,
        
        ]);

        return back()->with('success', 'Grade submitted successfully!');
    }
}
