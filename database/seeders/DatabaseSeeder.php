<?php

namespace Database\Seeders;

use App\Models\Diagnosis;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Diagnosis::truncate();
        \App\Models\Diagnosis::factory()
            ->count(100)
            ->create();
    }
}
