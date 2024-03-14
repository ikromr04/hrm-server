<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $languages = array(
      array('id' => '1', 'name' => 'Таджикский язык', 'created_at' => '2024-02-07 00:05:32', 'updated_at' => '2024-02-07 00:05:32'),
      array('id' => '2', 'name' => 'Русский язык', 'created_at' => '2024-02-07 00:05:41', 'updated_at' => '2024-02-07 00:05:41'),
      array('id' => '3', 'name' => 'Английский язык', 'created_at' => '2024-02-07 00:05:50', 'updated_at' => '2024-02-07 00:05:50'),
      array('id' => '4', 'name' => 'Узбекский язык', 'created_at' => '2024-02-07 00:05:59', 'updated_at' => '2024-02-07 00:05:59'),
      array('id' => '5', 'name' => 'Турецкий язык', 'created_at' => '2024-02-07 00:06:11', 'updated_at' => '2024-02-07 00:06:11'),
      array('id' => '6', 'name' => 'Немецкий язык', 'created_at' => '2024-02-07 00:06:19', 'updated_at' => '2024-02-07 00:06:19'),
      array('id' => '7', 'name' => 'Китайский язык', 'created_at' => '2024-02-07 00:06:28', 'updated_at' => '2024-02-07 00:06:28'),
      array('id' => '8', 'name' => 'Корейский язык', 'created_at' => '2024-02-07 00:06:36', 'updated_at' => '2024-02-07 00:06:36'),
      array('id' => '9', 'name' => 'Арабский язык', 'created_at' => '2024-02-07 00:07:25', 'updated_at' => '2024-02-07 00:07:52'),
      array('id' => '10', 'name' => 'Французский язык', 'created_at' => '2024-02-07 00:07:45', 'updated_at' => '2024-02-07 00:07:45'),
      array('id' => '11', 'name' => 'Индийский язык', 'created_at' => '2024-02-07 00:08:32', 'updated_at' => '2024-02-07 00:08:32'),
      array('id' => '12', 'name' => 'Польский язык', 'created_at' => '2024-03-04 06:16:36', 'updated_at' => '2024-03-04 06:16:36'),
      array('id' => '13', 'name' => 'Персидский', 'created_at' => '2024-03-04 11:16:39', 'updated_at' => '2024-03-04 11:16:39'),
      array('id' => '14', 'name' => 'Испанский', 'created_at' => '2024-03-04 11:31:15', 'updated_at' => '2024-03-04 11:31:15'),
      array('id' => '15', 'name' => 'Итальянский', 'created_at' => '2024-03-04 11:42:32', 'updated_at' => '2024-03-04 11:42:32')
    );

    foreach ($languages as $language) {
      Language::create([
        'id' => $language['id'],
        'name' => $language['name'],
        'created_at' => $language['created_at'],
        'updated_at' => $language['updated_at'],
      ]);
    }
  }
}
