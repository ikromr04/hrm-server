<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentsStoreRequest;
use App\Http\Requests\DepartmentsUpdateRequest;
use App\Models\Department;

class DepartmentController extends Controller
{
  public function index()
  {
    $department = Department::get();

    return response($department, 200);
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
    $department->title = $request->input('title');
    $department->update();

    return response($department, 200);
  }

  public function delete($id)
  {
    Department::find($id)->delete();

    return response()->noContent();
  }
}
