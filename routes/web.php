<?php

use App\Livewire\ContactForm;
use App\Livewire\ContactSubmissionList;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/contact');
Route::get('/contact', ContactForm::class)->name('contact');
Route::get('/submissions', ContactSubmissionList::class)
    ->middleware('basic.submissions')
    ->name('submissions');
