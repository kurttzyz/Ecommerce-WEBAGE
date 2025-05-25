<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'student_id',
        'name',
        'event',
        'date',
        'instructor',
        'certificate_no',
    ];
}
