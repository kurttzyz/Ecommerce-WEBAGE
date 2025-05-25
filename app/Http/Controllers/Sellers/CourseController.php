<?php

namespace App\Http\Controllers\Sellers;

use App\Models\User;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\MentorSession;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;


class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('mentor_id', Auth::id())
                 ->where('archived', false)
                 ->get();
        $information = MentorSession::with('mentor')->get();
        return view('seller.courses.index', compact('courses', 'information'));
    }


    public function archive($id)
    {
        $course = Course::findOrFail($id);
        
        // Archive the course
        $course->archived = true;
        $course->save();

        return redirect()->route('courses.index')->with('success', 'Course archived successfully.');
    }


    public function unarchive($id)
    {
        $course = Course::findOrFail($id);

        $course->archived = false;
        $course->save();

        return redirect()->route('courses.show.archive')->with('success', 'Course unarchived successfully.');
    }




    public function showarchive()
    {
       
        $archivedCourses = Course::where('mentor_id', Auth::id())
                                ->where('archived', true)
                                ->get();

        
        return view('seller.courses.archive', compact('archivedCourses'));
    }



    public function create()
    {
        return view('seller.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        Course::create([
            'mentor_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }

    public function show(Course $course)
    {
        // $this->authorize('view', $course); // Removed to allow open access
        $studentCount = \App\Models\SessionEnrollment::whereHas('session', function ($query) use ($course) {
    $query->where('course_id', $course->id);
})->count();

        return view('seller.courses.show', compact('course','studentCount'));
    }

    // Show the edit form
    public function edit(Course $course)
    {

        return view('seller.courses.edit', compact('course'));
    }

    // Handle the update request
    public function update(Request $request, Course $course)
    {
        // Ensure that the course belongs to the authenticated mentor
        if ($course->mentor_id != Auth::id()) {
            return redirect()->route('courses.index')->with('error', 'Unauthorized access.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        // Update the course
        $course->update([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    }

}
