<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Kalnoy\Nestedset\NodeTrait;

class Department extends Model
{
  use HasFactory, NodeTrait;

  protected $guarded = [];
  protected $hidden = ['pivot', 'users', '_lft', '_rgt', 'parent_id', 'created_at', 'updated_at'];
  protected $appends = ['employees', 'left', 'right', 'parent'];

  public function getLeftAttribute()
  {
    return $this->_lft;
  }

  public function getRightAttribute()
  {
    return $this->_rgt;
  }

  public function getParentAttribute()
  {
    return $this->parent_id;
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
        'avatarThumb' => $value->avatarThumb,
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
