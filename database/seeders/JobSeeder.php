<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $jobs = array(
      'Веб-разработчик',
      'Специалист по составлению досье',
      'Аналитик',
      'Переводчик',
      'Научный аналитик',
      'Научный редактор',
      'Дизайнер',
      'Программист',
    );

    foreach ($jobs as $job) {
      Job::create([
        'title' => $job,
      ]);
    }
  }
}
