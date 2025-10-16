<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactSubmission;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        ContactSubmission::factory()->count(20)->create();
    }
}
