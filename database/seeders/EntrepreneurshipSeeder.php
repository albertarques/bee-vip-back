<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Entrepreneurship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EntrepreneurshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Entrepreneurship::factory(5)->create();
    }
}
