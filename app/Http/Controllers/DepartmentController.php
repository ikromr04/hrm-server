<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentsStoreRequest;
use App\Http\Requests\DepartmentsUpdateRequest;
use App\Models\Department;

class DepartmentController extends Controller
{
  public function index()
  {
    $departments = Department::orderBy('title', 'asc')
      ->get();

    return response($departments, 200);
  }

  public function tree()
  {
    $departments = Department::get()->toTree();

    return response($departments, 200);
  }

  public function store(DepartmentsStoreRequest $request)
  {
    $department = new Department();
    $department->title = $request->input('title');
    $department->save();

    return response($department, 201);
  }

  public function update(DepartmentsUpdateRequest $request, $id)
  {
    $department = Department::find($id);
    if ($request->has('parent_id')) {
      $parent = Department::find($request->input('parent_id'));
      $parent->appendNode($department);
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
}
