<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vacation;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class VacationSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $users = User::get();

    $faker = Faker::create();

    foreach (range(1, 999) as $key) {
      Vacation::create([
        'user_id' => $faker->numberBetween(1, count($users)),
        'date' => $faker->dateTimeBetween('-9 years', '+1 year'),
      ]);
    }
  }
}
