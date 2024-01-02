<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Education;
use App\Models\LaborActivity;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EmployeeUpdateRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
  public function index()
  {
    $users = User::withDetails()->get();

    return response($users, 200);
  }

  public function show($id) {
    $user = User::withDetails()->find($id);

    if (!$user) {
      return response(['message' => 'Пользователь не найден.'], 404);
    }

    return response($user, 200);
  }

  public function update(EmployeeUpdateRequest $request, $id)
  {
    $user = User::withoutGlobalScopes()->find($id);
    if ($user->login != $request->login) {
      $validator = Validator::make($request->all(), ['login' => 'unique:users,login']);
      if ($validator->fails()) {
        throw ValidationException::withMessages([
          'login' => ['Этот логин уже занят.'],
        ]);
      }
    }

    $user->name = $request->name;
    $user->surname = $request->surname;
    $request->patronymic && $user->patronymic = $request->patronymic;
    $user->login = $request->login;
    $user->started_work_at = $request->started_work_at;
    $user->update();

    $request->has('jobs') && $user->jobs()->sync($request->jobs);
    $request->has('positions') && $user->positions()->sync($request->positions);

    return User::withDetails()->find($id);
  }

  public function updateAvatar($id)
  {
    $avatar = DB::table('users')->find($id)->avatar;

    if ($avatar && file_exists(public_path($avatar))) {
      unlink(public_path($avatar));
    }

    $file = request()->file('avatar');
    $fileName = uniqid() . '.' . $file->extension();
    $file->move(public_path('/uploads/img/employees'), $fileName);
    $avatar = '/uploads/img/employees/' . $fileName;

    DB::table('users')->where('id', $id)->update(['avatar' => $avatar]);

    return asset($avatar);
  }

  public function deleteAvatar($id)
  {
    $avatar = DB::table('users')->find($id)->avatar;

    if ($avatar && file_exists(public_path($avatar))) {
      unlink(public_path($avatar));
    }

    DB::table('users')->where('id', $id)->update(['avatar' => null ]);

    return '';
  }
}
