<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Certificates extends Controller
{
    public function studentCertificates($id)
    {
        $student = Auth::user(); // assuming User is the student model
        $certificates = Certificate::where('student_id', $id)->orderBy('created_at', 'desc')->get();
    
        return view('customer.certificate.index', compact('student', 'certificates'));
    }

    public function index()
    {
        $student = Auth::user(); // get the currently logged-in user

        $certificates = Certificate::where('student_id', $student->id)->get();
    
        return view('customer.certificate.view', compact('student', 'certificates'));
    }
    
}
