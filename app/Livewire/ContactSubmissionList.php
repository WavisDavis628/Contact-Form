<?php

namespace App\Livewire;

use App\Models\ContactSubmission;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ContactSubmissionList extends Component
{
    use WithPagination;

    #[Url] // persist "q" in the URL & ensure proper updates
    public string $q = '';

    public int $perPage = 10;

    public function updatingQ(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $term = trim($this->q);

        $submissions = ContactSubmission::query()
            ->when($term !== '', function ($query) use ($term) {
                $like = '%'.$term.'%';
                $query->where('email', 'like', $like)
                    ->orWhere('subject', 'like', $like);
            })
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.contact-submission-list', [
            'submissions' => $submissions,
        ])->layout('layouts.app', ['title' => 'Submissions']);
    }
}
