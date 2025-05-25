<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Store extends Model {
    protected $fillable = [
        'store_name',
        'slug',
        'details',
        'user_id',
      ];

// In Store model:
public function mentorCourses() {
  return $this->hasMany(Course::class, 'mentor_id', 'user_id');
}


public function mentorReviews()
{
    return $this->hasMany(MentorReview::class, 'store_id'); // Ensure the foreign key is correct
}




}
