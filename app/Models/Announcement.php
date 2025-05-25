<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{

        protected $fillable = ['course_id', 'title', 'body', 'mentor_id', 'created_at', 'updated_at'];
    public function mentorSession() // or course()
    {
        return $this->belongsTo(MentorSession::class); // or Course::class
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }
    

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id'); // or MentorSession::class, depending on your model name
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }
    


}
