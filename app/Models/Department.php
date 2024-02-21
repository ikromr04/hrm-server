<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Builder;

class Department extends Model
{
  use HasFactory, NodeTrait;

  protected $hidden = ['pivot', 'users'];
  protected $appends = ['employees'];

  protected static function booted()
  {
    static::addGlobalScope('order', function (Builder $builder) {
      $builder->orderBy('title')->select(
        'id',
        'title',
        '_lft as left',
        '_rgt as right',
        'parent_id as parent',
      );
    });
  }

  public function getEmployeesAttribute()
  {
    $employees = [];
    foreach ($this->users as $key => $value) {
      $employees[$key] = [
        'id' => $value->id,
        'name' => $value->name,
        'surname' => $value->surname,
        'patronymic' => $value->patronymic,
        'login' => $value->login,
        'avatar' => $value->avatar,
        'startedWorkAt' => $value->startedWorkAt,
        'previous' => $value->previous,
        'next' => $value->next,
        'languages' => $value->languages,
        'jobs' => $value->jobs,
        'positions' => $value->positions,
        'leader' => $value->pivot->leader,
      ];
    }
    return $employees;
  }

  public function users()
  {
    return $this->belongsToMany(User::class)->withPivot('leader');
  }
}
