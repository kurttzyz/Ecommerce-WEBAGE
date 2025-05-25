<?php

namespace App\Http\Controllers\Sellers;

use App\Models\Achievement;
use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Models\MentorSession;
use App\Models\SessionEnrollment;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MentorCertificate extends Controller
{

    public function create()
    {
        // Get the authenticated mentor
        $mentor = auth()->user();
    
        // Get the sessions that the mentor is associated with and load the students
        $sessions = DB::table('mentor_sessions')
        ->join('session_enrollments', 'mentor_sessions.id', '=', 'session_enrollments.session_id')
        ->join('users', 'session_enrollments.student_id', '=', 'users.id') // assuming students are stored in users table
        ->select(
            'mentor_sessions.id as session_id',
            'mentor_sessions.title as session_title',
            'users.id as student_id',
            DB::raw("CONCAT(users.first_name, ' ', users.last_name) as student_name")
        )
        ->get();
    
     

    
        // Pass the sessions (and students) to the view
        return view('seller.certificates.create', compact('sessions'));
    }
    
    
    
    
    

    public function generate(Request $request)
    {
        // Validate form input
        $request->validate([
            'student_id'     => 'required|exists:users,id',
            'session_id' => 'required|exists:mentor_sessions,id',
            'event' => 'required|string',
            'date' => 'required|date',
            'instructor' => 'required|string',
        ]);
    
        $mentor = auth()->user();
    
        // Get the session, and ensure it belongs to the authenticated mentor
        $session = DB::table('mentor_sessions')
            ->join('courses', 'mentor_sessions.course_id', '=', 'courses.id')
            ->where('mentor_sessions.id', $request->session_id)
            ->where('courses.mentor_id', $mentor->id)
            ->select('mentor_sessions.id as id', 'mentor_sessions.title')
            ->first();
    
        if (!$session) {
            return back()->withErrors(['session_id' => 'Invalid session or not owned by you.']);
        }
    
        // Get students enrolled in the session
        $students = DB::table('session_enrollments')
            ->join('users', 'session_enrollments.student_id', '=', 'users.id')
            ->where('session_enrollments.session_id', $request->session_id)
            ->select('users.id',  DB::raw("CONCAT(users.first_name, ' ', users.last_name) as student_name"))
            ->get();
    
        $created = 0;
    
        foreach ($students as $student) {
            Certificate::create([
                'student_id'     => $student->id, // or the correct ID
                'name' => $student->student_name,
                'event' => $request->event,
                'date' => $request->date,
                'instructor' => $request->instructor,
                'certificate_no' => strtoupper(uniqid('CERT-')),
            ]);
            $created++; 
        }
    
        return redirect()->route('certificates.index')->with('success', "$created certificate(s) successfully issued.");
    }
    
    

    public function show($id)
    {
        $certificate = Certificate::findOrFail($id);
        return view('seller.certificates.show', compact('certificate'));
    }
    

    public function index()
    {
        // Show all certificates, ordered by latest first
        $certificates = Certificate::orderBy('created_at', 'desc')->paginate(10);
        return view('seller.certificates.index', compact('certificates'));
    }

}
