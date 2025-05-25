<?php

namespace App\Http\Controllers\Sellers;

use App\Models\Course;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\MentorSession;
use App\Models\Mentor_Session;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{   

    public function create($course_id)
    {
    $course = Course::findOrFail($course_id);

    return view('seller.activities.create', compact('course'));
    }

    public function store(Request $request, $course_id)
{
    // Validate form inputs
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'due_date' => 'nullable|date',
        'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx,zip|max:2048', // Adjust file types and max size as needed
    ]);

    // Process the uploaded file if present
    $filePath = null;
    if ($request->hasFile('attachment')) {
        $file = $request->file('attachment');
        $filename = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('attachments', $filename, 'public');
    }

    // Create the activity
    Activity::create([
        'course_id' => $course_id,
        'title' => $request->title,
        'description' => $request->description,
        'due_date' => $request->due_date,
        'attachment_path' => $filePath, // Store the file path
    ]);

    return redirect()->route('courses.show', $course_id)->with('success', 'Activity created!');
}


    public function submissions($activityId)
    {
        $activity = Activity::with('submissions.student')->findOrFail($activityId);
        return view('mentor.activities.submissions', compact('activity'));
    }
}
