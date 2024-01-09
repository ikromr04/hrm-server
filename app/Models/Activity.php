<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Activity extends Model
{
  use HasFactory;

  protected $guarded = [];

  protected static function booted()
  {
    static::addGlobalScope('adapt-to-client', function (Builder $builder) {
      $builder->select(
        'id', 'user_id as userId', 'hired_at as hiredAt', 'dismissed_at as dismissedAt',
        'organization', 'job'
      );
    });
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
