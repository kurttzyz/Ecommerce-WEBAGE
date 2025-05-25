<?php

namespace App\Http\Controllers\Admin;

use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ManageCertificates extends Controller
{
    public function index()
    {
        $certificates = Certificate::orderBy('created_at', 'desc')->get();

        return view('admin.certificates.index', compact('certificates'));
    }


    public function studentCertificates($id)
    {
   
        $certificates = Certificate::where('student_id', $id)->orderBy('created_at', 'desc')->get();
    
        return view('admin.certificates.view', compact( 'certificates'));
    }


    public function destroy($id)
    {
        $certificate = Certificate::findOrFail($id);
        $certificate->delete();

        return redirect()->back()->with('success', 'Certificate deleted successfully.');
    }

}
