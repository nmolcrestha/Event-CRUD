<?php

namespace Database\Seeders;

use App\Models\Events;
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
        Events::factory()->count(10)->create();
    }
}
