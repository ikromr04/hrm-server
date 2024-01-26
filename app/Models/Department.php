<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Department extends Model
{
  use HasFactory, NodeTrait;

  public function employees()
  {
    // return $this->hasMany
  }
}
