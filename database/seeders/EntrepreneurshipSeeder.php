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
          'title' => 'Café Colombiano Black Toast',
          'name' => 'Rodrigo Suárez',
          'logo' => '',
          'product_img' => Storage::url('factory-img/cafe.jpeg'),
          'description' => 'Lorem ipsum dolor sit amet. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!',
          'price' => '100.5',
          'category_id' => '1',
          'avg_score' => '5',
          'cash_payment' => '0',
          'card_payment' => '1',
          'bizum_payment' => '0',
          'stock' => '34',
          'availability_state' => '2',
          'phone' => '777777777',
          'email' => 'cafecolombia@gmail.com',
          'location' => 'Medellín',
          'inspection_state' => '2',
        ]);

        Entrepreneurship::factory()->create([
          'title' => 'Diseño Web',
          'name' => 'Alberto Arqueso',
          'logo' => '',
          'product_img' => Storage::url('factory-img/diseno.png'),
          'description' => 'Lorem ipsum dolor sit amet. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!',
          'price' => '100.5',
          'category_id' => '2',
          'avg_score' => '5',
          'cash_payment' => '0',
          'card_payment' => '1',
          'bizum_payment' => '0',
          'stock' => '1',
          'availability_state' => '2',
          'phone' => '666666666',
          'email' => 'webdesign@gmail.com',
          'location' => 'Cali',
          'inspection_state' => '2',
        ]);

        Entrepreneurship::factory()->create([
          'title' => 'Desarrollo Web React JS',
          'name' => 'Alejandra Buritoki',
          'logo' => '',
          'product_img' => Storage::url('factory-img/desarrollo.png'),
          'description' => 'Lorem ipsum dolor sit amet. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!',
          'price' => '500',
          'category_id' => '3',
          'avg_score' => '4',
          'cash_payment' => '0',
          'card_payment' => '1',
          'bizum_payment' => '0',
          'stock' => '1',
          'availability_state' => '2',
          'phone' => '666666666',
          'email' => 'webdesign@gmail.com',
          'location' => 'Cartagena',
          'inspection_state' => '2',
        ]);

        Entrepreneurship::factory()->create([
          'title' => 'Quitamanchas Flash!',
          'name' => 'Francisca Rey',
          'logo' => '',
          'product_img' => Storage::url('factory-img/quitamanchas.jpg'),
          'description' => 'Lorem ipsum dolor sit amet. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!',
          'price' => '23',
          'category_id' => '4',
          'avg_score' => '3',
          'cash_payment' => '0',
          'card_payment' => '1',
          'bizum_payment' => '0',
          'stock' => '1',
          'availability_state' => '2',
          'phone' => '222222222',
          'email' => 'quitamanchas@gmail.com',
          'location' => 'Cartagena',
          'inspection_state' => '2',
        ]);

        Entrepreneurship::factory()->create([
          'title' => 'Maquillaje Premium',
          'name' => 'Guillerma Martinita',
          'logo' => '',
          'product_img' => Storage::url('factory-img/maquillaje.jpeg'),
          'description' => 'Lorem ipsum dolor sit amet. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!',
          'price' => '200',
          'category_id' => '5',
          'avg_score' => '3',
          'cash_payment' => '0',
          'card_payment' => '1',
          'bizum_payment' => '0',
          'stock' => '1',
          'availability_state' => '2',
          'phone' => '111111111',
          'email' => 'belleza@gmail.com',
          'location' => 'Barranquilla',
          'inspection_state' => '2',
        ]);

        Entrepreneurship::factory()->create([
          'title' => 'La Lenteja Álbum',
          'name' => 'Espantoso',
          'logo' => '',
          'product_img' => Storage::url('factory-img/lenteja.jpeg'),
          'description' => 'Lorem ipsum dolor sit amet. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!',
          'price' => '30',
          'category_id' => '6',
          'avg_score' => '5',
          'cash_payment' => '0',
          'card_payment' => '1',
          'bizum_payment' => '0',
          'stock' => '120',
          'availability_state' => '2',
          'phone' => '888888888',
          'email' => 'lalenteja@gmail.com',
          'location' => 'Bogotá',
          'inspection_state' => '2',
        ]);

        Entrepreneurship::factory(100)->create();
    }
}
