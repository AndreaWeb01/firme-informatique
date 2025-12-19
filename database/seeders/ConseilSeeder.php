<?php

namespace Database\Seeders;

use App\Models\Conseils;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConseilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Conseils::factory()->count(50)->create();
    }
}
