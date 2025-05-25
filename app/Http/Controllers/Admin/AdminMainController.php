<?php
namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Course;
use App\Models\Product;
use App\Models\Attendance;
use App\Models\SellerForm;
use Illuminate\Http\Request;
use App\Models\MentorSession;
use App\Models\HomePageSetting;
use App\Mail\ApproveApplication;
use App\Mail\DeclineApplication;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AdminMainController extends Controller {
    public function index(Request $request)
    {
        $role = $request->get('role');
        $month = $request->get('month');
        $year = $request->get('year');
    
        $usersQuery = User::query();
    
        // Role filter
        if ($role === '1') {
            $usersQuery->where('role', 1);
        } elseif ($role === '2') {
            $usersQuery->where('role', 2);
        }
    
        // Month and Year filter
        if ($month) {
            $usersQuery->whereMonth('created_at', $month);
        }
    
        if ($year) {
            $usersQuery->whereYear('created_at', $year);
        }
    
        $users = $usersQuery->get();
    
        // Recalculate counts using the same filter (optional)
        $filteredCounts = (clone $usersQuery)->selectRaw('
            COUNT(*) as total_users,
            SUM(CASE WHEN role = 0 THEN 1 ELSE 0 END) as total_admins,
            SUM(CASE WHEN role = 1 THEN 1 ELSE 0 END) as total_sellers,
            SUM(CASE WHEN role = 2 THEN 1 ELSE 0 END) as total_customers
        ')->first();
    
        $totalUsers = $filteredCounts->total_users;
        $totalAdmins = $filteredCounts->total_admins;
        $totalSellers = $filteredCounts->total_sellers;
        $totalCustomers = $filteredCounts->total_customers;
    
        // Revenue Data (unchanged unless you want it filtered too)
        $enrollments = DB::table('session_enrollments')
            ->selectRaw("MONTH(created_at) as month_number, DATE_FORMAT(created_at, '%M') as month_name, COUNT(*) as count")
            ->groupBy('month_number', 'month_name')
            ->orderBy('month_number')
            ->get();


            $studentAttendances = Attendance::orderBy('created_at')
            ->get()
            ->groupBy('student_id');
    
        $continuingCount = 0;
        $nonContinuingCount = 0;
    
        foreach ($studentAttendances as $studentId => $records) {
            $consecutiveAbsents = 0;
            $isNonContinuing = false;
    
            foreach ($records as $record) {
                if ($record->status === 'absent') {
                    $consecutiveAbsents++;
                    if ($consecutiveAbsents >= 3) {
                        $isNonContinuing = true;
                        break;
                    }
                } else {
                    $consecutiveAbsents = 0;
                }
            }
    
            if ($isNonContinuing) {
                $nonContinuingCount++;
            } else {
                $continuingCount++;
            }
        }
    
        $labels = $enrollments->pluck('month_name');
        $revenueData = $enrollments->pluck('count')->map(fn($count) => $count * 5000);


        $mentor = auth()->user();

        $totalSessions = Course::where('mentor_id', $mentor->id)->count();

        
        $sessionIds = MentorSession::whereHas('course', function ($query) use ($mentor) {
            $query->where('mentor_id', $mentor->id);
        })->pluck('id');


        // Get unique student IDs enrolled in those sessions
        $totalStudents = \DB::table('session_enrollments')
            ->whereIn('session_id', $sessionIds)
            ->distinct('student_id')
            ->count('student_id');
    
        return view('admin.admin', compact(
            'totalSellers',
            'totalUsers',
            'totalAdmins',
            'totalCustomers',
            'labels',
            'revenueData','continuingCount',
            'nonContinuingCount',
            'totalSessions',
            'sessionIds',
            'totalStudents'
        ));
    }
    
    

    public function setting(){
        $products = Product::all();
        $homepagesetting = HomePageSetting::first() ?? new HomepageSetting();
        return view('admin.setting', compact('products', 'homepagesetting'));
    }

    public function updatehomepagesetting(Request $request){
        $request->validate([
        'discounted_product_id' => 'required|exists:products,id',
        'discounted_amount' => 'required|numeric|min:1',
        'discount_heading' => 'required|string|max:255',
        'discount_subheading' => 'required|string|max:255',
        'featured_product_1_id' => 'nullable|exists:products,id',
        'featured_product_2_id' => 'nullable|exists:products,id',
        ]);

        $homepagesetting = HomePageSetting::first() ?? new HomepageSetting();
        $homepagesetting->fill($request->all());
        $homepagesetting->save();

        return redirect()->route('admin.settings')->with('success', 'Homepagesetting Updated Successfully!');
    }

    public function destroy ($id){
        $user = User::findOrFail($id);
          // Prevent deletion if user is an admin or has role 0
        if ($user->role === 0) {
            return redirect()->back()->with('error', 'Cannot delete an Admin user.');
        }
        $user->delete();
        return redirect()->back()->with('success', 'User Deleted Successfully!');
    }
    
    public function manage_user($role = null){

        if (in_array($role, ['1', '2', '0'])) {
            $users = User::where('role', $role)->get();
        } else {
            $users = User::all();
        }
    
        return view('admin.manage.user', compact('users', 'role'));
    }

    public function approve(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        $sellerForm = $user->sellers()->latest()->first();
        if ($sellerForm) {
            $sellerForm->status = 'approved';
            $sellerForm->is_archived = true; // Archive it
            $sellerForm->save();
        }
    
        $user->is_approved = true;
        $user->save();
    
        if ($request->hasFile('contract')) {
            $path = $request->file('contract')->store('contracts', 'public');
            $fullPath = storage_path("app/public/{$path}");
            Mail::to($user->email)->send(new ApproveApplication($user, $fullPath));
        }
    
        return redirect()->back()->with('success', 'Mentorship approved successfully.');
    }
    
    

    
    public function decline($id)
    {
        $user = User::findOrFail($id);
    
        $sellerForm = $user->sellers()->latest()->first();
        if ($sellerForm) {
            $sellerForm->status = 'declined';
            $sellerForm->is_archived = true; // Archive it
            $sellerForm->save();
        }
    
        Mail::to($user->email)->send(new DeclineApplication($user));
    
        $user->delete();
    
        return redirect()->back()->with('error', 'Mentorship request declined and user deleted.');
    }
    
    
    
    public function manage_revenues(Request $request)
{
    $month = $request->input('month');       // e.g. '03' for March
    $choice = $request->input('choice');     // e.g. session_id or course_id
    
    $query = DB::table('session_enrollments')
        ->join('sessions', 'session_enrollments.session_id', '=', 'sessions.id') // Join with the sessions table
        ->select('session_enrollments.session_id', 'session_enrollments.student_id') // Adjust 'title' if the column is different
        ->distinct(); // Avoid duplicate sessions if needed
    
    if ($month) {
        $query->whereMonth('session_enrollments.created_at', $month);
    }
    
    if ($choice) {
        $query->where('session_enrollments.session_id', $choice); // Adjust for filtering by choice
    }
    
    $sessions = $query->get();

    // Revenue calculations
    $enrollments = DB::table('session_enrollments')
        ->selectRaw("MONTH(created_at) as month_number, DATE_FORMAT(created_at, '%M') as month_name, COUNT(*) as count")
        ->groupBy('month_number', 'month_name')
        ->orderBy('month_number')
        ->get();

    $labels = $enrollments->pluck('month_name');
    $revenueData = $enrollments->pluck('count')->map(fn($count) => $count * 5000);

    return view('admin.manage.revenues', compact('labels', 'revenueData', 'sessions'));
}
    

    public function manage_stores(){
        return view('admin.manage.store');
    }

    public function cart_history(){
        return view('admin.cart.history');
    }

    public function order_history(){
        return view('admin.order.history');
    }

    public function application_form() {
        $sellers = SellerForm::where('is_archived', false) 
                             ->orderBy('created_at', 'desc')
                             ->get();
    
        $users = User::where('role', 2) 
                     ->orderBy('created_at', 'desc')
                     ->get();
    
        return view('admin.dashboard', compact('sellers', 'users'));
    }
    
    
    public function mentor_application_form(){
        
    }


    public function create()
    {
        return view('admin.manage.create'); // Blade form to create user
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'address' => 'required|string|max:255',
            'contact_number' => 'required|string|max:255',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:0,1,2' // Admin/Secretary = 0, Mentor = 1
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'address' => $request->address,
            'contact_number' => $request->contact_number,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('admin.manage.user')->with('success', 'New user created successfully!');
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.manage.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'address' => 'required|string|max:255',
            'contact_number' => 'required|string|max:255',
            'role' => 'required|in:0,1,2'
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only('first_name', 'last_name', 'email', 'address', 'contact_number', 'role'));

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }


    
    public function upload(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile_photos', 'public');

            // Delete old photo if it exists
            if (Auth::user()->profile_photo) {
                Storage::disk('public')->delete(Auth::user()->profile_photo);
            }

            Auth::user()->update(['profile_photo' => $path]);

            return response()->json([
                'message' => 'Profile updated successfully.',
                'image_url' => asset('storage/' . $path),
            ]);
        }

        return response()->json(['message' => 'No file uploaded.'], 422);
    }


    public function archived()
    {
        $archivedForms = SellerForm::where('is_archived', true)->latest()->get();
        return view('admin.archived', compact('archivedForms'));
    }



    public function viewUsers($id)
    {
     
    
        $users = User::with('sellers')->findOrFail($id);
        
        
        return view('admin.manage.index', compact('users'));
    }



}
