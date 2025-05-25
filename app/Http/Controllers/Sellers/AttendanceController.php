<?php

namespace App\Http\Controllers\Sellers;

use App\Models\User;
use App\Models\Course;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{
    public function create(Course $course)
    {
       $students = User::whereHas('mentorSessions', function ($query) use ($course) {
            $query->whereIn('session_id', $course->sessions()->pluck('id'));
            })->get();

            return view('seller.attendance.create', compact('course', 'students'));
    }


    public function store(Request $request, Course $course)
    {
        $request->validate([
            'date' => 'required|date',
            'status' => 'required|array',
        ]);

        foreach ($request->status as $student_id => $status) {
            Attendance::updateOrCreate(
                [
                    'course_id' => $course->id,
                    'student_id' => $student_id,
                    'date' => $request->date,
                ],
                ['status' => $status]
            );
        }

        return redirect()->route('courses.show', $course->id)->with('success', 'Attendance recorded.');
    }

}
