<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Inertia\Controller;
use Illuminate\Http\Request;
use App\Models\MentorSession;
use Illuminate\Support\Facades\Auth;
use App\Notifications\StudentEnrolled;
use App\Events\StudentEnrolledInSession;
use Illuminate\Container\Attributes\Log;

class SessionController extends Controller
{

    public function enroll($id)
    {
        $student = Auth::user();
        $session = MentorSession::with('course.mentor')->findOrFail($id);
    
        if (!$student || !$student->id) {
            return back()->with('error', 'Invalid student.');
        }
    

        if ($session->students()->where('student_id', $student->id)->exists()) {
            return back()->with('error', 'You are already enrolled in this session.');
        }
    

        $courseCount = MentorSession::whereHas('students', function ($query) use ($student) {
            $query->where('student_id', $student->id);
        })->distinct('course_id')->count('course_id');
    

        if ($courseCount >= 2) {
            return back()->with('error', 'You can only enroll in 2 different courses.');
        }
    

        $session->students()->attach($student->id);
    
  
        event(new StudentEnrolledInSession($session, $student));
    
        return redirect()->route('customer.class')->with('message', 'Successfully enrolled!');
    }
    


    



}
