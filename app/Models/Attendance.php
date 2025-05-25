<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['course_id', 'student_id', 'date', 'status', 'created_at', 'updated_at'];

    // Attendance.php
public function student()
{
    return $this->belongsTo(User::class);
}

}
