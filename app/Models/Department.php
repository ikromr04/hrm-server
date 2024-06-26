<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Department extends Model
{
  use HasFactory, NodeTrait;

  protected $guarded = [];
  protected $hidden = ['pivot'];

  public function users()
  {
    return $this->belongsToMany(User::class)
      ->withPivot('leader');
  }
}
