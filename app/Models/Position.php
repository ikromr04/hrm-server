<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Position extends Model
{
  use HasFactory;

  protected $guarded = [];
  protected $hidden = ['pivot', 'created_at', 'updated_at'];

  public function users()
  {
    return $this->belongsToMany(User::class);
  }
}
