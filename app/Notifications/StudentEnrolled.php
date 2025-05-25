<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudentEnrolled extends Notification
{
    use Queueable;

    protected $course;
    protected $student;

    public function __construct($course, $student)
    {
        $this->course = $course;
        $this->student = $student;
    }

    public function via($notifiable)
    {
        return ['database']; // or ['mail', 'database'] if you want to email too
    }

    public function toDatabase($notifiable)
    {
       
        return [
            'message' => "{$this->student->full_name} enrolled in your course {$this->course->title}.",
            'course_id' => $this->course->id,
            'student_id' => $this->student->id,
        ];
    }
}