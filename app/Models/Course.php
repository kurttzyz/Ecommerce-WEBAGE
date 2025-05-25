<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['mentor_id', 'title', 'description'];

    public function sessions()
    {
        return $this->hasMany(MentorSession::class);
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }


    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function category()
    {
    return $this->belongsTo(Category::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }



    public function students()
    {
        return $this->belongsToMany(User::class, 'session_enrollments', 'session_id', 'student_id')
                    ->withPivot('session_id');
    }

    public function classmates()
    {
        return $this->belongsToMany(User::class, 'session_enrollments', 'session_id', 'student_id');
    }


    
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    










}
