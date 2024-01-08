<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Education extends Model
{
  use HasFactory;

  protected $guarded = [];
  protected $hidden = ['user_id'];

  protected static function booted()
  {
    static::addGlobalScope('adapt_to_client', function (Builder $builder) {
      $builder->select(
        'id', 'user_id', 'started_at as startedAt', 'graduated_at as graduatedAt',
        'institution', 'faculty', 'form', 'speciality'
      );
    });
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
