<?php

namespace App\Services;

use App\Models\User;
use App\Models\Achievement;
use App\Models\AchievementProgress;
use Illuminate\Support\Facades\DB;

class AchievementService
{
    /**
     * Update progress for Best in Attendance.
     */
    public function updateAttendanceAchievement(User $user)
    {
        $totalClasses = $user->attendances()->count();
        $presentCount = $user->attendances()->where('status', 'present')->count();

        if ($totalClasses === 0) return;

        $progress = round(($presentCount / $totalClasses) * 100);
        $achievement = Achievement::where('title', 'Best in Attendance')->first();

        $this->updateProgress($user, $achievement, $progress);
    }

    /**
     * Generic method to update progress.
     */
    public function updateProgress(User $user, Achievement $achievement, int $progress)
    {
        $record = AchievementProgress::firstOrNew([
            'user_id' => $user->id,
            'achievement_id' => $achievement->id,
        ]);

        $record->progress = min($progress, 100);
        $record->completed = $progress >= 100;
        $record->save();
    }

    /**
     * Optional: Mark an achievement as 100% complete immediately.
     */
    public function completeAchievement(User $user, string $achievementTitle)
    {
        $achievement = Achievement::where('title', $achievementTitle)->firstOrFail();
        $this->updateProgress($user, $achievement, 100);
    }
}
