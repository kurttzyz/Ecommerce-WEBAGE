<?php

namespace App\Listeners;

use App\Notifications\StudentEnrolled;
use App\Events\StudentEnrolledInSession;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendStudentEnrolledNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(StudentEnrolledInSession $event)
    {
        $course = $event->session->course;

        // assuming Course has a `mentor()` relationship
        $mentor = $course->mentor;

        if ($mentor) {
            $mentor->notify(new StudentEnrolled($course, $event->student));
        }
    }

}
