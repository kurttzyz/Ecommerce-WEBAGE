<?php

namespace App\Http\Controllers\Sellers;

use App\Models\Course;
use App\Models\Session;
use Illuminate\Http\Request;
use App\Models\MentorSession;
use App\Models\Mentor_Session;
use App\Http\Controllers\Controller;

class MentorSessionController extends Controller
{
    public function create($courseId)
    {
    $course = Course::findOrFail($courseId);
    return view('seller.session.create', compact('course'));
    }


    public function store(Request $request, $courseId)
{
    $existingSessionCount = MentorSession::where('course_id', $courseId)->count();

    if ($existingSessionCount >= 1) {
        return redirect()->route('courses.show', $courseId)
            ->with('error', 'Only one session is allowed per course.');
    }

    $request->validate([
        'title' => 'required',
        'description' => 'nullable',
        'schedule' => 'required|date',
    ]);

    MentorSession::create([
        'course_id' => $courseId,
        'title' => $request->title,
        'description' => $request->description,
        'schedule' => $request->schedule,
        'max_students' => 20, // default
    ]);


    return redirect()->route('courses.show', $courseId)
        ->with('success', 'Session created.');
}

}
