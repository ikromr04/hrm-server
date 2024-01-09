<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('education', function (Blueprint $table) {
      $table->id();
      $table->integer('user_id');
      $table->string('institution');
      $table->string('faculty');
      $table->string('speciality');
      $table->string('form');
      $table->timestamp('started_at');
      $table->timestamp('graduated_at');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('education');
  }
}
