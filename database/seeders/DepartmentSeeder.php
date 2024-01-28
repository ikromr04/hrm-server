<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
  public function run()
  {
    $departments = array(
      'Отдел дизайн',
      'Отдел бухгалтерии',
      'Отдел веб разработок',
      'Отдел цифрогого маркетинга',
      'Отдел аудит',
      'Отдел Мониторинга',
    );

    foreach ($departments as $department) {
      Department::create([
        'title' => $department,
      ]);
    }
  }
}
