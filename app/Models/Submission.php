<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = ['activity_id', 'student_id', 'content', 'attachment', 'submitted_at', 'grade'];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

  

}
