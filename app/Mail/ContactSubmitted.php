<?php

namespace App\Mail;

use App\Models\ContactSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public ContactSubmission $submission) {}

    public function build(): self
    {
        return $this->subject('New contact submission: '.$this->submission->subject)
            ->markdown('mail.contact-submitted', [
                's' => $this->submission,
            ]);
    }
}
