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
        Entrepreneurship::factory(10)->create();
        // Entrepreneurship::factory()->create([
        //   'name' => 'Alimentación',
        //   'description' => 'Lorem ipsum dolor sit amet. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!',
        //   'image' => 'some random image',
        //   'rating' => '2.5'
        // ]);
    }
}
