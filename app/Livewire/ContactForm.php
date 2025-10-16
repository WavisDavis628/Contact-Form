<?php

namespace App\Livewire;

use App\Models\ContactSubmission;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name = '';
    public string $email = '';
    public string $subject = '';
    public string $message = '';

    // Spam controls
    public string $website = '';     // honeypot
    public int $started_at = 0;       // time-trap (unix timestamp)

    public function mount(): void
    {
        $this->started_at = now()->getTimestamp();
    }

    protected function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'max:120'],
            'email'   => ['required', 'string', 'email:filter', 'max:190'],
            'subject' => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:2000'],
        ];
    }

    public function submit()
    {
        // Basic spam checks
        if ($this->website !== '') {
            // bot filled hidden field
            $this->addError('name', 'Something went wrong. Please try again.');
            return;
        }

        if (now()->getTimestamp() - $this->started_at < 3) { // 3s time-trap
            $this->addError('name', 'No Spamming, wait a bit longer.');
            return;
        }

        // (Optional) simple rate limit by IP+email (3/minute)
        $key = sprintf('contact:%s:%s', request()->ip(), strtolower($this->email));
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $this->addError('email', 'Too many attempts. Please try again in a minute.');
            return;
        }
        RateLimiter::hit($key, 60); // decay in 60 seconds

        $validated = $this->validate();

        // Persist to DB with meta
        $submission = ContactSubmission::create([
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'subject'    => $validated['subject'],
            'message'    => $validated['message'],
            'ip'         => request()->ip(),
            'user_agent' => (string) request()->userAgent(),
        ]);

        // Clear fields so they aren't duplicated on refresh
        $this->reset(['name', 'email', 'subject', 'message', 'website']);

        // Redirect (PRG pattern) so refresh doesn't resubmit
        return redirect()->route('contact')->with('status', 'Got it, we will contact you shortly.');
    }

    public function render()
    {
        return view('livewire.contact-form')->layout('layouts.app', [
            'title' => 'Contact Us',
        ]);
    }
}