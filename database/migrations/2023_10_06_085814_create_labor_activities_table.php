<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaborActivitiesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('labor_activities', function (Blueprint $table) {
      $table->id();
      $table->integer('user_id');
      $table->timestamp('hired_at');
      $table->timestamp('dismissed_at');
      $table->string('organization');
      $table->string('job');
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
    Schema::dropIfExists('labor_activities');
  }
}
