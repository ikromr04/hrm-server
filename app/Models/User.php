<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  protected $guarded = [];
  protected $casts = ['email_verified_at' => 'datetime'];
  protected $hidden = ['password', 'pivot', 'langs'];
  protected $appends = ['previous', 'next', 'languages'];

  protected static function booted()
  {
    static::addGlobalScope('adapt-to-client', function (Builder $builder) {
      $builder->select(
        'id', 'name', 'surname', 'patronymic', 'login', 'password', 'avatar',
        'started_work_at as startedWorkAt'
      );
    });
  }

  public function getAvatarAttribute()
  {
    if ($this->attributes['avatar']) {
      return asset($this->attributes['avatar']);
    }
    return '';
  }

  public function getPreviousAttribute()
  {
    $prevId = User::where('id', '<', $this->attributes['id'])->max('id');
    if (!$prevId) {
      $prevId = User::orderBy('id', 'desc')->first()->id;
    }

    return $prevId;
  }

  public function getNextAttribute()
  {
    $nextId = User::where('id', '>', $this->attributes['id'])->min('id');
    if (!$nextId) {
      $nextId = User::orderBy('id', 'asc')->first()->id;
    }

    return $nextId;
  }

  public function getLanguagesAttribute()
  {
    $langs = [];
    foreach ($this->langs as $key => $value) {
      $langs[$key] = [
        'id' => $value->id,
        'name' => $value->name,
        'level' => $value->pivot->level,
      ];
    }
    return $langs;
  }

  public function scopeWithDetails($query)
  {
    return $query->orderBy('surname')->with(['jobs', 'positions', 'langs', 'details', 'departments']);
  }

  public function details()
  {
    return $this->hasOne(Detail::class)
      ->select(
          'user_id',
          'birth_date as birthDate',
          'gender',
          'nationality',
          'citizenship',
          'address',
          'email',
          'tel_1 as tel1',
          'tel_2 as tel2',
          'family_status as familyStatus',
          'children',
      );
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

  public function langs()
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
      ->select('id', 'title');
  }
}
