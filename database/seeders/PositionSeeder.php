<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $positions = array(
      'Руководитель Организации',
      'Директор',
      'Руководитель Функционального Подразделений',
      'Руководитель Отдела',
      'Ключевые Менеджера',
      'Менеджер 2',
      'Линейные Менеджера',
      'Главные Специалисты',
      'Ведущие Специалисты',
      'Специалисты',
      'Стажеры',
      'Поддерживающий Персонал',
    );

    foreach ($positions as $position) {
      Position::create([
        'title' => $position,
      ]);
    }
  }
}
