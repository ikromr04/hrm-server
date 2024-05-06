<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  protected $guarded = [];
  protected $casts = ['email_verified_at' => 'datetime'];

  public function details()
  {
    return $this->hasOne(Detail::class);
  }

  public function jobs()
  {
    return $this->belongsToMany(Job::class)
      ->select('id', 'title');
  }

  public function positions()
  {
    return $this->belongsToMany(Position::class)
      ->select('id', 'title');
  }

  public function languages()
  {
    return $this->belongsToMany(Language::class)
      ->withPivot('level');
  }

  public function educations()
  {
    return $this->hasMany(Education::class)
      ->orderBy('started_at', 'asc');
  }

  public function activities()
  {
    return $this->hasMany(Activity::class)
      ->orderBy('hired_at', 'desc');
  }

  public function departments()
  {
    return $this->belongsToMany(Department::class)
      ->withPivot('leader');
  }

  public function role()
  {
    return $this->belongsTo(Role::class);
  }

  public function equipments()
  {
    return $this->hasMany(Equipment::class);
  }

  public function vacations()
  {
    return $this->hasMany(Vacation::class);
  }
}
