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
    $langs = [
      'Английский',
      'Русский',
      'Арабский',
      'Казахский',
      'Таджикский',
      'Турецкий',
      'Узбекский',
    ];

    foreach ($langs as $lang) {
      Language::create([
        'name' => $lang,
      ]);
    }
  }
}
