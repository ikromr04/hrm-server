<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Language extends Model
{
  use HasFactory;

  protected $guarded = [];

  protected static function booted()
  {
    static::addGlobalScope('adapt', function (Builder $builder) {
      $builder->select('id', 'name')->orderBy('name');
    });
  }

  public function users()
  {
    return $this->belongsToMany(User::class);
  }
}
