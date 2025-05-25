<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MentorSession extends Model
{
    protected $fillable = ['course_id', 'title', 'description', 'schedule', 'max_students'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'session_enrollments', 'session_id', 'student_id')->withTimestamps();
    }


    public function activities()    
    {
        return $this->hasMany(Activity::class);
    }

   public function announcements()
    {
        return $this->hasMany(Announcement::class, 'course_id');
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    


    // In Mentor model or User model (depending on your structure)
    public function session()
    {
        return $this->hasMany(MentorSession::class, 'course_id'); // Adjust if your relationship is different
    }


}
