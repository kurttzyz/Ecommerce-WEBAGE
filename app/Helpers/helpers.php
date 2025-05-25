<?php

use App\Models\User;
use App\Models\MentorSession;

if (!function_exists('getCourseStudents')) {
    function getCourseStudents($courseId)
    {
        return User::whereHas('sessionEnrollments.session', function ($query) use ($courseId) {
            $query->where('course_id', $courseId);
        })->get();
    }
}



if (!function_exists('getRoleLabel')) {
    function getRoleLabel($role)
    {
        return match ($role) {
            0 => 'Admin',
            1 => 'Mentor',
            2 => 'Student',
            default => 'Unknown',
        };
    }
}

