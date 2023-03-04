<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->create([
          'name' => 'Alimentación',
        ]);

        Category::factory()->create([
          'name' => 'Diseño',
        ]);

        Category::factory()->create([
          'name' => 'Desarrollo',
        ]);

        Category::factory()->create([
          'name' => 'Limpieza',
        ]);

        Category::factory()->create([
          'name' => 'Belleza',
        ]);

        Category::factory()->create([
          'name' => 'Música',
        ]);

        Category::factory(10)->create();
    }
}
