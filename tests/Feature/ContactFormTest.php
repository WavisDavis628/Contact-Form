<?php

namespace Tests\Feature;

use App\Livewire\ContactForm;
use App\Mail\ContactSubmitted;
use App\Models\ContactSubmission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Ensure sqlite file exists if using file-based sqlite during tests
        if (config('database.default') === 'sqlite' && config('database.connections.sqlite.database') !== ':memory:') {
            @mkdir(database_path(), 0777, true);
            @touch(database_path('database.sqlite'));
        }
    }

    #[Test]
    public function it_validates_required_fields(): void
    {
        $t = Livewire::test(ContactForm::class);

        // Ensure spam checks won't short-circuit validation
        if (property_exists($t->instance(), 'website')) {
            $t->set('website', '');
        }
        if (property_exists($t->instance(), 'hp_field')) {
            $t->set('hp_field', '');
        }
        if (property_exists($t->instance(), 'started_at')) {
            $t->set('started_at', now()->subSeconds(5)->timestamp);
        }

        $t->set('name', '')
          ->set('email', '')      // keep empty to trigger "required"
          ->set('subject', '')
          ->set('message', '')
          ->call('submit')
          ->assertHasErrors(['name', 'email', 'subject', 'message']);
    }

    #[Test]
    public function it_saves_and_sends_mail_on_success(): void
    {
        Mail::fake();
        RateLimiter::clear('contact:127.0.0.1');

        $t = Livewire::test(ContactForm::class);

        if (property_exists($t->instance(), 'website')) {
            $t->set('website', '');
        }
        if (property_exists($t->instance(), 'hp_field')) {
            $t->set('hp_field', '');
        }
        if (property_exists($t->instance(), 'started_at')) {
            $t->set('started_at', now()->subSeconds(5)->timestamp);
        }

        $t->set('name', 'Jane Tester')
          ->set('email', 'jane@example.com')
          ->set('subject', 'Hello')
          ->set('message', 'Testing the contact form.')
          ->call('submit')
          ->assertHasNoErrors();

        $this->assertTrue(
            ContactSubmission::query()->where('email', 'jane@example.com')->exists()
        );

        Mail::assertSent(ContactSubmitted::class, 1);
    }
}
