<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Submission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
  
     public function submit(Request $request, $activityId)
    {

           $user = auth()->user();

    // Prevent duplicate
        if (Submission::where('student_id', $user->id)->where('activity_id', $activityId)->exists()) {
            return back()->with('error', 'You have already submitted this activity.');
        }

        $request->validate([
            'content' => 'nullable|string',
            'attachment' => 'nullable|file|max:10240', // max 10MB
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('submissions', 'public');
        }

        Submission::create([
            'activity_id' => $activityId,
            'student_id' => Auth::id(),
            'content' => $request->input('content'),
            'attachment' => $attachmentPath,
            'submitted_at' => now(),
        ]);

        return back()->with('success', 'Work submitted successfully!');
    }


    public function updateGrade(Request $request, Submission $submission)
    {
        $request->validate([
            'grade' => 'required|integer|min:0|max:100',
        ]);

        $submission->grade = $request->grade;
        $submission->save();

        return redirect()->back()->with('success', 'Grade updated successfully!');
    }

}
