<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ContactForm;

Route::redirect('/', '/contact');
Route::get('/contact', ContactForm::class)->name('contact');
