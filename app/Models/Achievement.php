<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{

    protected $fillable = ['title', 'description', 'criteria', 'issued_by', 'level'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'achievement_progress', 'achievement_id', 'user_id')
                    ->withPivot('progress', 'completed');
    }


    // Achievement.php
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    // In Achievement.php
    public function issuer()
    {
        return $this->belongsTo(User::class, 'issued_by');
    }


    
}
