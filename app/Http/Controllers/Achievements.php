<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;

class Achievements extends Controller
{
    public function index()
    {
        $user = auth()->user(); 
        $achievements = $user->achievements()->get(); 
        return view('customer.achievements.index', compact('achievements'));
    }
    
    public function updateProgress(Request $request, Achievement $achievement)
    {
        $user = auth()->user();
    
        $currentProgress = $user->achievements()->where('achievement_id', $achievement->id)->first()->pivot->progress;
    
        if ($currentProgress < 100) {
            $newProgress = min(100, $currentProgress + 10);
            $user->achievements()->updateExistingPivot($achievement->id, ['progress' => $newProgress]);
        }
    
        return back()->with('success', 'Progress updated!');
    }
    

}
