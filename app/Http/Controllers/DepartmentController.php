<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentsStoreRequest;
use App\Http\Requests\DepartmentsUpdateRequest;
use App\Models\Department;
use stdClass;

class DepartmentController extends Controller
{
  public function index()
  {
    $departments = Department::select(
      'id',
      'title',
    )
      ->orderBy('title')
      ->get();

    return response($departments, 200);
  }

  public function store(DepartmentsStoreRequest $request)
  {
    $department = new Department();
    $department->title = $request->input('title');

    if ($request->has('parent_id')) {
      if ($request->input('parent_id')) {
        $parent = Department::find($request->input('parent_id'));
        $parent->appendNode($department);
      } else {
        $department->parent_id = null;
      }
    }
    $department->save();
    $employees = [];
    if ($request->has('employees')) {
      $employees = $request->input('employees');
    }
    if ($request->has('leaders')) {
      foreach ($request->input('leaders') as $leader) {
        $employees[$leader] = ['leader' => true];
      }
    }
    if ($request->has('children')) {
      foreach ($request->input('children') as $childId) {
        $child = Department::find($childId);
        $department->appendNode($child);
      }
    }
    $department->users()->sync($employees);

    return response(Department::get()->toTree(), 201);
  }

  public function update(DepartmentsUpdateRequest $request, $id)
  {
    $department = Department::find($id);
    if ($request->has('parent_id')) {
      if ($request->input('parent_id')) {
        $parent = Department::find($request->input('parent_id'));
        $parent->appendNode($department);
      } else {
        $department->parent_id = null;
      }
    }
    $employees = [];
    if ($request->has('employees')) {
      $employees = $request->input('employees');
    }
    if ($request->has('leaders')) {
      foreach ($request->input('leaders') as $leader) {
        $employees[$leader] = ['leader' => true];
      }
    }
    if ($request->has('children')) {
      foreach ($request->input('children') as $childId) {
        $child = Department::find($childId);
        $department->appendNode($child);
      }
    }
    $department->users()->sync($employees);
    $request->has('title') && $department->title = $request->input('title');
    $department->update();

    return response(Department::get()->toTree(), 200);
  }

  public function delete($id)
  {
    $department = Department::find($id);
    $department->delete();

    return response()->noContent();
  }

  public function tree()
  {
    $tree = Department::get()
      ->toTree();

    // $departments = DepartmentController::adaptDepartmentsTree($departments);

    return response(DepartmentController::adaptTreeToClient($tree), 200);
  }

  public static function adaptTreeToClient($tree)
  {
    $clientTree = [];

    foreach ($tree as $department) {
      $branch = new stdClass();
      $branch->id = $department->id;
      $branch->title = $department->title;
      $branch->left = $department->_lft;
      $branch->right = $department->_rgt;
      $branch->parent = $department->parent_id;
      $branch->children = DepartmentController::adaptTreeToClient($department->children);

      $employees = [];
      foreach ($department->users as $key => $value) {
        $employees[$key] = [
          'id' => $value->id,
          'name' => $value->name,
          'surname' => $value->surname,
          'patronymic' => $value->patronymic,
          'login' => $value->login,
          'avatar' => $value->avatar ? asset($value->avatar) : '',
          'avatarThumb' => $value->avatar_thumb ? asset($value->avatar_thumb) : '',
          'startedWorkAt' => $value->started_work_at,
          'languages' => DepartmentController::adaptLanguagesToClient($value->languages),
          'jobs' => $value->jobs,
          'positions' => $value->positions,
          'leader' => $value->pivot->leader,
        ];
      }
      $branch->employees = $employees;

      array_push($clientTree, $branch);
    }

    return $clientTree;
  }

  public static function adaptLanguagesToClient($languages)
  {
    $clientLanguages = [];
    foreach ($languages as $key => $language) {
      $clientLanguages[$key] = [
        'id' => $language->id,
        'name' => $language->name,
        'level' => $language->pivot->level,
      ];
    }

    return $clientLanguages;
  }
}
