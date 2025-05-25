<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
    Achievement::insert([
        [
            'title' => 'Best in Attendance',
            'description' => 'Awarded to students with perfect attendance throughout the season.',
            'criteria' => '- 100% attendance for all scheduled classes\n- No tardiness or early leave records',
            'issued_by' => 'Mentor or Secretary',
            'level' => 'All Levels',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Most Improved Student',
            'description' => 'Recognizes noticeable progress in musical skills and performance.',
            'criteria' => '- Significant improvement in technique, posture, or expression\n- Recognized by mentor\n- Active class participation',
            'issued_by' => 'Mentor',
            'level' => 'Beginner to Intermediate',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Outstanding Performance Award',
            'description' => 'Given to students who delivered exceptional performances in events or recitals.',
            'criteria' => '- Solo or lead role in at least one music event\n- Rated “Excellent” by at least two mentors or event judges',
            'issued_by' => 'Program Head or Administrator',
            'level' => 'All Levels',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Theory Whiz',
            'description' => 'Awarded to students who excel in music theory assessments and applications.',
            'criteria' => '- 90% and above in all theory exams\n- Shows consistent understanding and use of theory during practice',
            'issued_by' => 'Mentor',
            'level' => 'All Levels',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Peer Mentor Award',
            'description' => 'Recognizes students who support and guide their peers during sessions.',
            'criteria' => '- Helps classmates voluntarily\n- Shows leadership and encouragement\n- Nominated by mentor or peers',
            'issued_by' => 'Mentor or Program Coordinator',
            'level' => 'Intermediate and up',
            'created_at' => now(),
            'updated_at' => now(),
        ]
    ]);
}
}
