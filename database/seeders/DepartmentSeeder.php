<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
  public function run()
  {
    $departments = array(
      array('id' => '1','title' => 'Департамент управления человеческими  ресурсами','created_at' => '2024-02-07 05:10:38','updated_at' => '2024-02-07 05:11:17','_lft' => '1','_rgt' => '2','parent_id' => NULL),
      array('id' => '2','title' => 'Департамент аналитики и статистики','created_at' => '2024-02-07 05:10:47','updated_at' => '2024-02-07 05:11:06','_lft' => '3','_rgt' => '4','parent_id' => NULL),
      array('id' => '3','title' => 'Отдел анализа производителей','created_at' => '2024-02-07 05:11:32','updated_at' => '2024-02-07 05:11:32','_lft' => '5','_rgt' => '6','parent_id' => NULL),
      array('id' => '4','title' => 'Отдел планирование производство и логистики','created_at' => '2024-02-07 05:11:53','updated_at' => '2024-02-07 05:11:53','_lft' => '7','_rgt' => '8','parent_id' => NULL),
      array('id' => '5','title' => 'Отдел Дизайна','created_at' => '2024-02-07 05:12:11','updated_at' => '2024-02-07 05:12:11','_lft' => '9','_rgt' => '10','parent_id' => NULL),
      array('id' => '6','title' => 'Отдел Товарных Знаков','created_at' => '2024-02-07 05:12:23','updated_at' => '2024-02-07 05:12:23','_lft' => '11','_rgt' => '12','parent_id' => NULL),
      array('id' => '7','title' => 'Отдел Веб-разработок','created_at' => '2024-02-07 05:12:37','updated_at' => '2024-02-07 05:12:37','_lft' => '13','_rgt' => '14','parent_id' => NULL),
      array('id' => '8','title' => 'Отдел регистрации','created_at' => '2024-02-07 05:12:51','updated_at' => '2024-02-07 05:12:51','_lft' => '15','_rgt' => '16','parent_id' => NULL),
      array('id' => '9','title' => 'Отдел составления досье','created_at' => '2024-02-07 05:13:07','updated_at' => '2024-02-07 05:13:07','_lft' => '17','_rgt' => '18','parent_id' => NULL),
      array('id' => '10','title' => 'Отдел мониторинга и анализа рынка','created_at' => '2024-02-07 05:13:20','updated_at' => '2024-02-07 05:13:20','_lft' => '19','_rgt' => '20','parent_id' => NULL),
      array('id' => '11','title' => 'Научный отдел','created_at' => '2024-02-07 05:13:38','updated_at' => '2024-02-07 05:13:38','_lft' => '21','_rgt' => '22','parent_id' => NULL),
      array('id' => '12','title' => 'Отдел цифрового маркетинга','created_at' => '2024-02-07 05:13:53','updated_at' => '2024-02-07 05:13:53','_lft' => '23','_rgt' => '24','parent_id' => NULL),
      array('id' => '13','title' => 'Отдел контрактного производства','created_at' => '2024-02-07 05:14:05','updated_at' => '2024-02-07 05:14:05','_lft' => '25','_rgt' => '26','parent_id' => NULL),
      array('id' => '14','title' => 'Отдел мониторинга и оптимизации рабочих процессов','created_at' => '2024-02-07 05:14:20','updated_at' => '2024-02-07 05:14:20','_lft' => '27','_rgt' => '28','parent_id' => NULL),
      array('id' => '15','title' => 'Отдел аналитики','created_at' => '2024-02-07 05:15:10','updated_at' => '2024-02-07 05:15:10','_lft' => '29','_rgt' => '30','parent_id' => NULL),
      array('id' => '16','title' => 'Отдел управления проектов','created_at' => '2024-02-07 05:15:33','updated_at' => '2024-02-07 05:15:33','_lft' => '31','_rgt' => '32','parent_id' => NULL),
      array('id' => '17','title' => 'Отдел развития продуктового портфеля','created_at' => '2024-02-07 05:16:25','updated_at' => '2024-02-07 09:58:40','_lft' => '33','_rgt' => '34','parent_id' => NULL)
    );

    foreach ($departments as $department) {
      Department::create([
        'id' => $department['id'],
        'title' => $department['title'],
        'created_at' => $department['created_at'],
        'updated_at' => $department['updated_at'],
      ]);
    }
  }
}
