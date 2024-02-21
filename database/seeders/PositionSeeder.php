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
      array('id' => '1','title' => 'Руководитель Департамента','created_at' => '2024-02-07 05:19:06','updated_at' => '2024-02-07 05:19:06'),
      array('id' => '2','title' => 'Руководитель Отдела','created_at' => '2024-02-07 05:19:29','updated_at' => '2024-02-07 05:19:29'),
      array('id' => '3','title' => 'МРБ','created_at' => '2024-02-07 05:19:37','updated_at' => '2024-02-07 05:19:37'),
      array('id' => '4','title' => 'КПГ','created_at' => '2024-02-07 05:19:45','updated_at' => '2024-02-07 05:19:45'),
      array('id' => '5','title' => 'Ведущий специалист','created_at' => '2024-02-07 05:19:54','updated_at' => '2024-02-07 05:19:54'),
      array('id' => '6','title' => 'Технический аналитик','created_at' => '2024-02-07 05:20:04','updated_at' => '2024-02-07 05:20:04'),
      array('id' => '7','title' => 'Переводчик','created_at' => '2024-02-07 05:20:14','updated_at' => '2024-02-07 05:20:14'),
      array('id' => '8','title' => 'Графический дизайнер','created_at' => '2024-02-07 05:20:27','updated_at' => '2024-02-07 05:20:27'),
      array('id' => '9','title' => 'Научный Редактор','created_at' => '2024-02-07 05:20:38','updated_at' => '2024-02-07 05:20:38'),
      array('id' => '10','title' => 'Дизайнер - Научный редактор','created_at' => '2024-02-07 05:20:50','updated_at' => '2024-02-07 05:20:50'),
      array('id' => '11','title' => 'Аналитик','created_at' => '2024-02-07 05:20:58','updated_at' => '2024-02-07 05:20:58'),
      array('id' => '12','title' => 'Поддерживающий Персонал','created_at' => '2024-02-07 05:21:34','updated_at' => '2024-02-07 05:21:34'),
      array('id' => '13','title' => 'Специалист по составлению регистрационного досье','created_at' => '2024-02-07 05:21:45','updated_at' => '2024-02-07 05:21:45'),
      array('id' => '14','title' => 'Регистратор Досье','created_at' => '2024-02-07 05:21:53','updated_at' => '2024-02-07 05:21:53'),
      array('id' => '15','title' => 'Копирайтер','created_at' => '2024-02-07 05:22:19','updated_at' => '2024-02-07 05:22:19'),
      array('id' => '16','title' => 'СММ специалист','created_at' => '2024-02-07 05:22:28','updated_at' => '2024-02-07 05:22:28'),
      array('id' => '17','title' => 'Видеомейкер','created_at' => '2024-02-07 05:23:01','updated_at' => '2024-02-07 05:23:01'),
      array('id' => '18','title' => 'Стажер','created_at' => '2024-02-07 05:23:52','updated_at' => '2024-02-07 05:23:52'),
      array('id' => '19','title' => 'Научный аналитик','created_at' => '2024-02-12 05:48:49','updated_at' => '2024-02-12 05:48:49'),
      array('id' => '20','title' => 'Веб-мастер','created_at' => '2024-02-12 10:04:19','updated_at' => '2024-02-12 10:04:19'),
      array('id' => '21','title' => 'Проектный менеджер','created_at' => '2024-02-12 10:30:21','updated_at' => '2024-02-12 10:30:21'),
      array('id' => '22','title' => 'Специалист','created_at' => '2024-02-12 10:45:38','updated_at' => '2024-02-12 10:45:38'),
      array('id' => '23','title' => 'Младший специалист','created_at' => '2024-02-12 11:14:32','updated_at' => '2024-02-12 11:14:32'),
      array('id' => '24','title' => 'Администратор','created_at' => '2024-02-12 11:23:01','updated_at' => '2024-02-12 11:23:01')
    );

    foreach ($positions as $position) {
      Position::create([
        'id' => $position['id'],
        'title' => $position['title'],
        'created_at' => $position['created_at'],
        'updated_at' => $position['updated_at'],
      ]);
    }
  }
}
