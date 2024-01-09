<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Education extends Model
{
  use HasFactory;

  protected $guarded = [];

  protected static function booted()
  {
    static::addGlobalScope('adapt-to-client', function (Builder $builder) {
      $builder->select(
        'id', 'user_id as userId', 'started_at as startedAt', 'graduated_at as graduatedAt',
        'institution', 'faculty', 'form', 'speciality'
      );
    });
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
