<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Builder;

class Department extends Model
{
  use HasFactory, NodeTrait;

  protected $hidden = ['pivot'];

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
