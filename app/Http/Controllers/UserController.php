<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Detail;

class UserController extends Controller
{
  public function index()
  {
    $users = User::withDetails()->get();

    return response($users, 200);
  }

  public function show($id)
  {
    $user = User::withDetails()->find($id);

    return response($user, 200);
  }

  public function update(EmployeeUpdateRequest $request, $id)
  {
    $user = User::withoutGlobalScopes()->find($id);
    $request->has('name') && $user->name = $request->input('name');
    $request->has('surname') && $user->surname = $request->input('surname');
    $request->has('patronymic') && $user->patronymic = $request->input('patronymic');
    $request->has('login') && $user->login = $request->input('login');
    $request->has('started_work_at') && $user->started_work_at = $request->input('started_work_at');
    $user->isDirty() && $user->update();

    $request->has('jobs') && $user->jobs()->sync($request->jobs);
    $request->has('positions') && $user->positions()->sync($request->positions);

    if ($request->has('details')) {
      $detail = Detail::where('user_id', $user->id)->first();
      $request->has('details.birth_date') && $detail->birth_date = $request->input('details.birth_date');
      $request->has('details.gender') && $detail->gender = $request->input('details.gender');
      $request->has('details.nationality') && $detail->nationality = $request->input('details.nationality');
      $request->has('details.citizenship') && $detail->citizenship = $request->input('details.citizenship');
      $request->has('details.address') && $detail->address = $request->input('details.address');
      $request->has('details.email') && $detail->email = $request->input('details.email');
      $request->has('details.tel_1') && $detail->tel_1 = $request->input('details.tel_1');
      $request->has('details.tel_2') && $detail->tel_2 = $request->input('details.tel_2');
      $request->has('details.family_status') && $detail->family_status = $request->input('details.family_status');
      $request->has('details.children') && $detail->children = $request->input('details.children');
      $detail->isDirty() && $detail->update();
    }

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
