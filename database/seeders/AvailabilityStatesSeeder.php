<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AvailabilityStatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\AvailabilityState::create([
            'name' => 'unavailable',
        ]);

        \App\Models\AvailabilityState::create([
            'name' => 'available',
         ]);
    }
}
