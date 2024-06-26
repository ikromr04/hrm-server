<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
  use HasFactory;

  protected $guarded = [];
  protected $hidden = ['pivot'];

  public function users()
  {
    return $this->belongsToMany(User::class);
  }
}
