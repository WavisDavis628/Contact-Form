<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ContactForm;
use App\Livewire\ContactSubmissionList;

Route::redirect('/', '/contact');
Route::get('/contact', ContactForm::class)->name('contact');
Route::get('/submissions', ContactSubmissionList::class)->name('submissions');
