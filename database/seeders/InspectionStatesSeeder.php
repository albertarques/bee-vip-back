<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InspectionStatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\InspectionState::create([
            'name' => 'pending',

        ]);
        \App\Models\InspectionState::create([

            'name' => 'approved',

        ]);
        \App\Models\InspectionState::create([

            'name' => 'denied',
        ]);
    }
}
