<?php
namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Achievement;
use App\Models\MentorSession;
use App\Models\AchievementProgress;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $courses = MentorSession::all();
        return view('admin.product.manage', compact('courses'));
    }

    public function review_manage()
    {
        $achievements = Achievement::with('users')->get();
        return view('admin.product.manage_product_review', compact('achievements'));
    }

    public function destroy($id)
    {
        $course = MentorSession::findOrFail($id);
        $course->delete();

        return redirect()->route('product.manage')->with('success', 'Course deleted successfully.');
    }

    public function delete_review($id)
    {
        $achievement = AchievementProgress::findOrFail($id);
        $achievement->delete();

        return redirect()->route('review.manage')->with('success', 'Achievement deleted successfully.');
    }

    public function viewachievements(){
        $achievements = Achievement::with('users')->get();
        return view('admin.product.display_achievements', compact('achievements'));
    }
    

}
