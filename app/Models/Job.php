<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Job extends Model
{
  use HasFactory;

  protected $guarded = [];
  protected $hidden = ['pivot'];

  protected static function booted()
  {
    static::addGlobalScope('adapt', function (Builder $builder) {
      $builder->select('id', 'title');
    });
  }

  public function users()
  {
    return $this->belongsToMany(User::class);
  }
}
