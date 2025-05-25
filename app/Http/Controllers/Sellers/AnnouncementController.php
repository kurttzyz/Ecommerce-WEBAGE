<?php

namespace App\Http\Controllers\Sellers;

use App\Models\Course;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnnouncementController extends Controller
{
 public function create(Course $course)
    {
        return view('seller.announcements.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $course->announcements()->create([
            'title' => $request->title,
            'body' => $request->body,
            'mentor_id' => auth()->id(),
        ]);

        return redirect()->route('courses.show', $course->id)->with('success', 'Announcement posted.');
    }

    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();

        return redirect()->back()->with('success', 'Announcement deleted successfully.');
    }


}
