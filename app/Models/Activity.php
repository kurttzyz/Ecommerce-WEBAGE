<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['course_id', 'title', 'description', 'due_date', 'attachment_path'];

    public function session()
    {
        return $this->belongsTo(MentorSession::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

     public function course()
    {
        return $this->belongsTo(Course::class);
    }
}