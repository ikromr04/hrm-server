<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
  public function run()
  {
    $departments = array(
      array('id' => '1', 'title' => 'Департамент управления человеческими  ресурсами', '_lft' => '1', '_rgt' => '2', 'parent_id' => NULL, 'created_at' => '2024-02-06 17:10:38', 'updated_at' => '2024-02-06 17:11:17'),
      array('id' => '2', 'title' => 'Департамент аналитики и статистики', '_lft' => '3', '_rgt' => '12', 'parent_id' => NULL, 'created_at' => '2024-02-06 17:10:47', 'updated_at' => '2024-02-29 07:06:28'),
      array('id' => '3', 'title' => 'Отдел анализа производителей', '_lft' => '4', '_rgt' => '5', 'parent_id' => '2', 'created_at' => '2024-02-06 17:11:32', 'updated_at' => '2024-02-29 07:07:12'),
      array('id' => '4', 'title' => 'Отдел планирование производство и логистики', '_lft' => '51', '_rgt' => '52', 'parent_id' => NULL, 'created_at' => '2024-02-06 17:11:53', 'updated_at' => '2024-02-29 09:15:35'),
      array('id' => '5', 'title' => 'Отдел Дизайна', '_lft' => '16', '_rgt' => '17', 'parent_id' => '18', 'created_at' => '2024-02-06 17:12:11', 'updated_at' => '2024-02-29 06:15:24'),
      array('id' => '6', 'title' => 'Отдел Товарных Знаков', '_lft' => '18', '_rgt' => '19', 'parent_id' => '18', 'created_at' => '2024-02-06 17:12:23', 'updated_at' => '2024-02-29 06:15:24'),
      array('id' => '7', 'title' => 'Отдел Веб-разработок', '_lft' => '14', '_rgt' => '15', 'parent_id' => '18', 'created_at' => '2024-02-06 17:12:37', 'updated_at' => '2024-02-29 06:15:24'),
      array('id' => '8', 'title' => 'Отдел регистрации', '_lft' => '32', '_rgt' => '33', 'parent_id' => '22', 'created_at' => '2024-02-06 17:12:51', 'updated_at' => '2024-02-29 06:51:17'),
      array('id' => '9', 'title' => 'Отдел составления досье', '_lft' => '34', '_rgt' => '35', 'parent_id' => '22', 'created_at' => '2024-02-06 17:13:07', 'updated_at' => '2024-02-29 06:51:17'),
      array('id' => '10', 'title' => 'Отдел мониторинга и финансового контроля Эволет Европы', '_lft' => '24', '_rgt' => '25', 'parent_id' => '21', 'created_at' => '2024-02-06 17:13:20', 'updated_at' => '2024-02-29 06:50:02'),
      array('id' => '11', 'title' => 'Научный отдел', '_lft' => '6', '_rgt' => '7', 'parent_id' => '2', 'created_at' => '2024-02-06 17:13:38', 'updated_at' => '2024-02-29 07:07:12'),
      array('id' => '12', 'title' => 'Отдел цифрового маркетинга', '_lft' => '20', '_rgt' => '21', 'parent_id' => '18', 'created_at' => '2024-02-06 17:13:53', 'updated_at' => '2024-02-29 06:15:24'),
      array('id' => '13', 'title' => 'Отдел контрактного производства Тдж', '_lft' => '48', '_rgt' => '49', 'parent_id' => '26', 'created_at' => '2024-02-06 17:14:05', 'updated_at' => '2024-02-29 06:57:39'),
      array('id' => '14', 'title' => 'Отдел мониторинга и оптимизации рабочих процессов', '_lft' => '8', '_rgt' => '9', 'parent_id' => '2', 'created_at' => '2024-02-06 17:14:20', 'updated_at' => '2024-02-29 07:07:12'),
      array('id' => '15', 'title' => 'Отдел аналитики', '_lft' => '42', '_rgt' => '43', 'parent_id' => '25', 'created_at' => '2024-02-06 17:15:10', 'updated_at' => '2024-02-29 06:55:46'),
      array('id' => '16', 'title' => 'Отдел управления проектов', '_lft' => '44', '_rgt' => '45', 'parent_id' => '25', 'created_at' => '2024-02-06 17:15:33', 'updated_at' => '2024-02-29 06:55:46'),
      array('id' => '17', 'title' => 'Отдел развития продуктового портфеля', '_lft' => '10', '_rgt' => '11', 'parent_id' => '2', 'created_at' => '2024-02-06 17:16:25', 'updated_at' => '2024-02-29 07:07:12'),
      array('id' => '18', 'title' => 'Департамент маркетинга', '_lft' => '13', '_rgt' => '22', 'parent_id' => NULL, 'created_at' => '2024-02-29 06:15:24', 'updated_at' => '2024-02-29 07:08:58'),
      array('id' => '19', 'title' => 'Отдел управления расходами Эволет Таджикистан', '_lft' => '28', '_rgt' => '29', 'parent_id' => '21', 'created_at' => '2024-02-29 06:47:14', 'updated_at' => '2024-02-29 06:50:02'),
      array('id' => '20', 'title' => 'Отдел платежной реконсиляции', '_lft' => '26', '_rgt' => '27', 'parent_id' => '21', 'created_at' => '2024-02-29 06:49:21', 'updated_at' => '2024-02-29 06:50:02'),
      array('id' => '21', 'title' => 'Департамент финансового контроля и аудита', '_lft' => '23', '_rgt' => '30', 'parent_id' => NULL, 'created_at' => '2024-02-29 06:50:02', 'updated_at' => '2024-02-29 06:50:02'),
      array('id' => '22', 'title' => 'Департамент регистрации и документации', '_lft' => '31', '_rgt' => '36', 'parent_id' => NULL, 'created_at' => '2024-02-29 06:51:17', 'updated_at' => '2024-02-29 06:51:17'),
      array('id' => '23', 'title' => 'Департамент инновации и автоматизации', '_lft' => '37', '_rgt' => '40', 'parent_id' => NULL, 'created_at' => '2024-02-29 06:53:03', 'updated_at' => '2024-02-29 06:54:14'),
      array('id' => '24', 'title' => 'Отдел автоматизации рабочих процессов', '_lft' => '38', '_rgt' => '39', 'parent_id' => '23', 'created_at' => '2024-02-29 06:53:55', 'updated_at' => '2024-02-29 06:54:14'),
      array('id' => '25', 'title' => 'Департамент развития', '_lft' => '41', '_rgt' => '46', 'parent_id' => NULL, 'created_at' => '2024-02-29 06:55:46', 'updated_at' => '2024-02-29 06:55:46'),
      array('id' => '26', 'title' => 'Департамент контрактного производства', '_lft' => '47', '_rgt' => '50', 'parent_id' => NULL, 'created_at' => '2024-02-29 06:57:39', 'updated_at' => '2024-02-29 06:57:39')
    );

    foreach ($departments as $department) {
      Department::create([
        'id' => $department['id'],
        'title' => $department['title'],
        '_lft' => $department['_lft'],
        '_rgt' => $department['_rgt'],
        'parent_id' => NULL,
        'created_at' => $department['created_at'],
        'updated_at' => $department['updated_at'],
      ]);
    }

    foreach ($departments as $department) {
      $table = Department::find($department['id']);
      $table->parent_id = $department['parent_id'];
      $table->save();
    }
  }
}
