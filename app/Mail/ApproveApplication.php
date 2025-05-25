<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApproveApplication extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $contractPath;

    public function __construct($user, $contractPath)
    {
        $this->user = $user;
        $this->contractPath = $contractPath;
    }

    public function build()
    {
        return $this->subject('Your Mentorship Application Has Been Approved')
                    ->view('emails.approved')
                    ->with(['user' => $this->user])
                    ->attach($this->contractPath, [
                        'as' => 'Mentor_Contract.pdf',
                        'mime' => 'application/pdf',
                    ]);
    }
}

