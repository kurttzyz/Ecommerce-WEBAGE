<?php

namespace App\Events;

use App\Models\User;
use App\Models\MentorSession;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StudentEnrolledInSession
{
    use Dispatchable, SerializesModels;

    public $session;
    public $student;

    public function __construct(MentorSession $session, User $student)
    {
        $this->session = $session;
        $this->student = $student;
    }
    
}