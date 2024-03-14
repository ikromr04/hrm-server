<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Language extends Model
{
  use HasFactory;

  protected $guarded = [];
  // protected $hidden = ['created_at', 'updated_at'];

  // protected static function booted()
  // {
  //   static::addGlobalScope('order', function (Builder $builder) {
  //     $builder->orderBy('name');
  //   });
  // }

  public function users()
  {
    return $this->belongsToMany(User::class);
  }
}
