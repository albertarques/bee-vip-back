<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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

    $this->call([
      CategorySeeder::class
    ]);

    $this->call([
      AvailabilityStatesSeeder::class
    ]);

    $this->call([
      InspectionStatesSeeder::class
    ]);

    $this->call([
      RoleAndPermissionSeeder::class
    ]);

    $this->call([
      UserSeeder::class
    ]);

    $this->call([
      EntrepreneurshipSeeder::class
    ]);

    $this->call([
      CommentsSeeder::class
    ]);

    $this->call([
      OrderSeeder::class
    ]);

    $this->call([
      OrderDetailSeeder::class
    ]);

    $this->call([
      PaymentMethodsSeeder::class
    ]);
  }
}
