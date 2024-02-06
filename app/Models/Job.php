<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Job extends Model
{
  use HasFactory;

  protected $guarded = [];
  protected $hidden = ['pivot', 'updated_at', 'created_at'];

  protected static function booted()
  {
    static::addGlobalScope('order', function (Builder $builder) {
      $builder->orderBy('title');
    });
  }

  public function users()
  {
    return $this->belongsToMany(User::class);
  }
}
