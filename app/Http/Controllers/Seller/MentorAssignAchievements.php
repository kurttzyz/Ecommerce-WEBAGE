<?php

namespace App\Http\Controllers\Seller;

use App\Models\User;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MentorAssignAchievements extends Controller
{
   // Show the available achievements for a student
   public function show(User $student_id)
   {
        $student = User::find($student_id);

   
       // Check if student is enrolled in one of the mentor's sessions
       $sessions = DB::table('mentor_sessions')
       ->join('courses', 'mentor_sessions.course_id', '=', 'courses.id') // join to access mentor_id
       ->join('session_enrollments', 'mentor_sessions.id', '=', 'session_enrollments.session_id')
       ->join('users', 'session_enrollments.student_id', '=', 'users.id')
       ->where('courses.mentor_id', auth()->id()) // filter by current mentor
       ->select(
           'mentor_sessions.id as session_id',
           'mentor_sessions.title as session_title',
           'users.id as student_id',
           DB::raw("CONCAT(users.first_name, ' ', users.last_name) as student_name")

       )
       ->get();
   
   
       $achievements = Achievement::all();
       $assigned = $student->achievements->pluck('id')->toArray();
   
       return view('seller.achievements.show', compact('student', 'achievements', 'assigned'));
   }
   // Assign an achievement to a student
   public function assign(Request $request, $student_id)
{
    $request->validate([
        'achievement_id' => 'required|exists:achievements,id',
    ]);

    $mentor = auth()->user();

    // Make sure the student is truly enrolled under this mentor's session
    $enrolled = DB::table('mentor_sessions')
        ->join('session_enrollments', 'mentor_sessions.id', '=', 'session_enrollments.session_id')
        ->join('courses', 'mentor_sessions.course_id', '=', 'courses.id')
        ->where('courses.mentor_id', $mentor->id)
        ->where('session_enrollments.student_id', $student_id)
        ->exists();

    if (!$enrolled) {
        return back()->with('error', 'You cannot assign achievements to students not enrolled in your sessions.');
    }

    // Fetch student securely without the 'role' filter
    $student = User::find($student_id);

    if (!$student) {
        return back()->with('error', 'Invalid student.');
    }

    // Assign achievement
    $student->achievements()->syncWithoutDetaching([
        $request->achievement_id => ['completed' => true, 'progress' => 100],
    ]);

    return back()->with('success', 'Achievement assigned successfully!');
}

   // Assign achievements to all students enrolled in sessions
   public function assignToEnrolledStudents(Request $request)
   {
       $mentor = auth()->user(); // Get the authenticated mentor
       
       // Get sessions that the mentor is associated with
       $sessions = DB::table('mentor_sessions')
           ->join('session_enrollments', 'mentor_sessions.id', '=', 'session_enrollments.session_id')
           ->join('users', 'session_enrollments.student_id', '=', 'users.id')
           ->where('mentor_sessions.mentor_id', $mentor->id) // Ensure only sessions associated with the mentor are considered
           ->select(
               'mentor_sessions.id as session_id',
               'mentor_sessions.title as session_title',
               'users.id as student_id',
               DB::raw("CONCAT(users.first_name, ' ', users.last_name) as student_name")

           )
           ->get();

       // Get the selected achievement to assign
       $achievement_id = $request->input('achievement_id');
       $achievement = Achievement::find($achievement_id);

       if (!$achievement) {
           return back()->with('error', 'Invalid achievement.');
       }

       // Loop through the sessions and assign the achievement to each student
       foreach ($sessions as $session) {
           // Ensure the student is enrolled in the session
           $student = User::find($session->student_id);
           
           if ($student && $student->role === 'student') {
               // Assign achievement to the student (without detaching previous assignments)
               $student->achievements()->syncWithoutDetaching([
                   $achievement_id => ['completed' => true],
               ]);
           }
       }

       return back()->with('success', 'Achievement assigned to enrolled students successfully!');
   }



   public function assignToSingleStudent(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'achievement_id' => 'required|exists:achievements,id',
        ]);

        $mentor = auth()->user();
        $student_id = $request->input('student_id');

        // Verify student is enrolled in mentor's sessions
        $enrolled = DB::table('mentor_sessions')
            ->join('session_enrollments', 'mentor_sessions.id', '=', 'session_enrollments.session_id')
            ->join('courses', 'mentor_sessions.course_id', '=', 'courses.id')
            ->where('courses.mentor_id', $mentor->id)
            ->where('session_enrollments.student_id', $student_id)
            ->exists();

        

        if (!$enrolled) {
            return back()->with('error', 'You cannot assign achievements to students not enrolled in your sessions.');
        }

        $student = User::find($student_id);

        if (!$student) {
            return back()->with('error', 'Invalid student.');
        }

        $achievement_id = $request->input('achievement_id');

        $student->achievements()->syncWithoutDetaching([
            $achievement_id => ['completed' => true, 'progress' => 100],
        ]);

        return back()->with('success', 'Achievement assigned successfully!');
    }

   // View all students and their available achievements
   public function index()
   {
       $mentor = auth()->user();
   
       // Get students enrolled in sessions under courses that belong to this mentor
       $students = DB::table('courses')
           ->join('mentor_sessions', 'courses.id', '=', 'mentor_sessions.course_id')
           ->join('session_enrollments', 'mentor_sessions.id', '=', 'session_enrollments.session_id')
           ->join('users', 'session_enrollments.student_id', '=', 'users.id')
           ->where('courses.mentor_id', $mentor->id)
           ->select('users.*',
           DB::raw("CONCAT(users.first_name, ' ', users.last_name) as full_name"))
           ->distinct()
           ->get();


           $assigned = [];

    foreach ($students as $student) {
        $user = User::find($student->id);
        $assigned[$student->id] = $user->achievements->pluck('id')->toArray();
    }

   
       $achievements = Achievement::all();
   
       return view('seller.achievements.index', compact('students', 'achievements', 'assigned'));
   }


   public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'criteria' => 'required|string',
            'issued_by' => 'required|string',
            'level' => 'required|string',
        ]);

        Achievement::create($validated);

        return redirect()->back()->with('success', 'Achievement added successfully!');
    }


    public function createa(){
        return view('seller.achievements.create');
    }
}
