<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Order;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use Notifiable;
   

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'address',
        'contact_number',
        'verification_code',
        'email_verified_at',
        'profile_photo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');  
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);  
    }

    public function products(){
    return $this->hasMany(Product::class, 'seller_id'); 
    }

    public function sellers(){
    return $this->hasMany(SellerForm::class); 
    }

    public function enrolledCourses() {
    return $this->belongsToMany(Course::class, 'session_enrollments', 'student_id', 'session_id');
}

    public function getEnrolledCoursesAttribute()
    {
        return $this->mentorSessions()->with('course')->get()->pluck('course')->unique('id');
    }

    public function mentorSessions()
    {
        return $this->belongsToMany(MentorSession::class, 'session_enrollments', 'student_id', 'session_id')->withTimestamps();
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'session_enrollments')->withPivot('session_id');
    }


    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function sessions()
    {
        return $this->hasMany(SessionEnrollment::class, 'student_id'); // Assuming a mentor has many sessions
    }



    public function session()
    {
        return $this->hasMany(MentorSession::class, 'mentor_id');
    }



    public function responses()
    {
        return $this->hasMany(Response::class, 'student_id');
    }


    public function certificates() {
        return $this->hasMany(Certificate::class, 'student_id');
    }




    public function achievements()
    {
        return $this->belongsToMany(Achievement::class, 'achievement_progress', 'user_id', 'achievement_id')
                    ->withPivot('progress', 'completed')
                    ->withTimestamps();
    }


    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function ownedMentorSessions()
    {
        return $this->hasMany(MentorSession::class, 'course_id');
    }


    public function store()
    {
        return $this->hasOne(Store::class, 'user_id'); // Assuming store has a mentor_id
    }
    

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

}
