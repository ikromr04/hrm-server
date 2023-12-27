<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalDataTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('personal_data', function (Blueprint $table) {
      $table->id();
      $table->integer('user_id');
      $table->timestamp('birth_date')->nullable();
      $table->string('gender')->nullable();
      $table->string('nationality')->nullable();
      $table->string('citizenship')->nullable();
      $table->string('address')->nullable();
      $table->string('email')->nullable();
      $table->string('tel_1')->nullable();
      $table->string('tel_2')->nullable();
      $table->string('family_status')->nullable();
      $table->text('children')->nullable();
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
    Schema::dropIfExists('personal_data');
  }
}
