<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SessionEnrollment extends Model
{
     use HasFactory;
     protected $table = 'session_enrollments';

    protected $fillable = ['session_id', 'student_id'];

    public function session()
    {
        return $this->belongsTo(MentorSession::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'session_enrollments');
    }

        public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }


}
