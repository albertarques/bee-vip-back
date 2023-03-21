<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
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
        Entrepreneurship::factory()->create([
          'user_id' => 1,
          'title' => 'Café Colombiano Black Toast',
          'logo' => 'images/default/default_logo.png',
          'product_img' => 'images/default/default_product_img.png',
          'description' => 'Lorem ipsum dolor sit amet. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!',
          'price' => 100.5,
          'category_id' => 1,
          'avg_score' => 5,
          'cash_payment' => 0,
          'card_payment' => 1,
          'bizum_payment' => 0,
          'stock' => 34,
          'availability_state' => 2,
          'phone' => '777777777',
          'email' => 'cafecolombia@gmail.com',
          'location' => 'Medellín',
          'inspection_state' => 2,
        ]);

        Entrepreneurship::factory()->create([
          'user_id' => 2,
          'title' => 'Diseño Web',
          'logo' => 'images/default/default_logo.png',
          'product_img' => 'images/default/default_product_img.png',
          'description' => 'Lorem ipsum dolor sit amet. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!',
          'price' => 100.5,
          'category_id' => 2,
          'avg_score' => 5,
          'cash_payment' => 0,
          'card_payment' => 1,
          'bizum_payment' => 0,
          'stock' => 1,
          'availability_state' => 2,
          'phone' => '666666666',
          'email' => 'webdesign@gmail.com',
          'location' => 'Cali',
          'inspection_state' => 2,
        ]);

        Entrepreneurship::factory()->create([
          'user_id' => 3,
          'title' => 'Desarrollo Web React JS',
          'logo' => 'images/default/default_logo.png',
          'product_img' => 'images/default/default_product_img.png',
          'description' => 'Lorem ipsum dolor sit amet. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!',
          'price' => 500,
          'category_id' => 3,
          'avg_score' => 4,
          'cash_payment' => 0,
          'card_payment' => 1,
          'bizum_payment' => 0,
          'stock' => 1,
          'availability_state' => 2,
          'phone' => '666666666',
          'email' => 'webdesign@gmail.com',
          'location' => 'Cartagena',
          'inspection_state' => 2,
        ]);

        Entrepreneurship::factory()->create([
          'user_id' => 4,
          'title' => 'Laravel PHP',
          'logo' => 'images/default/default_logo.png',
          'product_img' => 'images/default/default_product_img.png',
          'description' => 'Lorem ipsum dolor sit amet. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!',
          'price' => 320,
          'category_id' => 3,
          'avg_score' => 4,
          'cash_payment' => 0,
          'card_payment' => 1,
          'bizum_payment' => 0,
          'stock' => 1,
          'availability_state' => 2,
          'phone' => '6666663366',
          'email' => 'laravel@gmail.com',
          'location' => 'Cartagena',
          'inspection_state' => 2,
        ]);

        Entrepreneurship::factory()->create([
          'user_id' => 5,
          'title' => 'Restaurante El Buen Parcero',
          'logo' => 'images/default/default_logo.png',
          'product_img' => 'images/default/default_product_img.png',
          'description' => 'Lorem ipsum dolor sit amet. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!',
          'price' => 50,
          'category_id' => 3,
          'avg_score' => 4,
          'cash_payment' => 0,
          'card_payment' => 1,
          'bizum_payment' => 0,
          'stock' => 1,
          'availability_state' => 2,
          'phone' => '6666663366',
          'email' => 'paisa@gmail.com',
          'location' => 'Cali',
          'inspection_state' => 2,
        ]);

        Entrepreneurship::factory()->create([
          'user_id' => 6,
          'title' => 'Quitamanchas Flash!',
          'logo' => 'images/default/default_logo.png',
          'product_img' => 'images/default/default_product_img.png',
          'description' => 'Lorem ipsum dolor sit amet. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!',
          'price' => 23.50,
          'category_id' => 4,
          'avg_score' => 3,
          'cash_payment' => 0,
          'card_payment' => 1,
          'bizum_payment' => 0,
          'stock' => 1,
          'availability_state' => 2,
          'phone' => '222222222',
          'email' => 'quitamanchas@gmail.com',
          'location' => 'Cartagena',
          'inspection_state' => 2,
        ]);

        Entrepreneurship::factory()->create([
          'user_id' => 7,
          'title' => 'Maquillaje Premium',
          'logo' => 'images/default/default_logo.png',
          'product_img' => 'images/default/default_product_img.png',
          'description' => 'Lorem ipsum dolor sit amet. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!',
          'price' => 200,
          'category_id' => 5,
          'avg_score' => 3,
          'cash_payment' => 0,
          'card_payment' => 1,
          'bizum_payment' => 0,
          'stock' => 1,
          'availability_state' => 2,
          'phone' => '111111111',
          'email' => 'belleza@gmail.com',
          'location' => 'Barranquilla',
          'inspection_state' => 2,
        ]);

        Entrepreneurship::factory()->create([
          'user_id' => 8,
          'title' => 'La Lenteja Álbum',
          'logo' => 'images/default/default_logo.png',
          'product_img' => 'images/default/default_product_img.png',
          'description' => 'Lorem ipsum dolor sit amet. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!',
          'price' => 30,
          'category_id' => 6,
          'avg_score' => 5,
          'cash_payment' => 0,
          'card_payment' => 1,
          'bizum_payment' => 0,
          'stock' => 120,
          'availability_state' => 2,
          'phone' => '888888888',
          'email' => 'lalenteja@gmail.com',
          'location' => 'Bogotá',
          'inspection_state' => 2,
        ]);

        Entrepreneurship::factory(100)->create();
    }
}
