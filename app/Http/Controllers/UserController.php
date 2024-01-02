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

  public function store()
  {
    // $fields = $request->validate([
      // 'name' => 'required|string',
      // 'login' => 'required|unique:users,login',
      // 'password' => 'required|string|confirmed',
    // ]);

    // $user = User::create([
    //   'name' => $fields['name'],
    //   'login' => $fields['login'],
    //   'password' => bcrypt($fields['password']),
    // ]);

    // $user->token = $user->createToken('token')->plainTextToken;

    // return $user;
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

    return User::withDetails()->find($id);
    // $user = User::find($employeeId);

    // if (request('login') != $user->login) {
    //   request()->validate([
    //     'login' => 'required|unique:users,login',
    //   ]);
    //   $user->update(['login' => request('login')]);
    // }

    // $user->update([
    //   'name' => request('name'),
    //   'surname' => request('surname'),
    //   'patronymic' => request('patronymic'),
    //   'started_work_at' => request('started_work_at'),
    // ]);

    // $user->jobs()->sync(request('jobs'));
    // $user->positions()->sync(request('positions'));

    // $user = User::with('jobs', 'positions', 'languages')->find($employeeId);

    // return $user;
  }

  // public function updatePersonalData($employeeId)
  // {
  //   $personalData = PersonalData::where('user_id', $employeeId)->first();
  //   if ($personalData) {
  //     $personalData->update([
  //       'birth_date' => request('birth_date'),
  //       'gender' => request('gender'),
  //       'nationality' => request('nationality'),
  //       'citizenship' => request('citizenship'),
  //       'address' => request('address'),
  //       'email' => request('email'),
  //       'tel_1' => request('tel_1'),
  //       'tel_2' => request('tel_2'),
  //       'family_status' => request('family_status'),
  //       'children' => request('children'),
  //     ]);
  //     return $personalData;
  //   }
  //   $personalData = PersonalData::create([
  //     'user_id' => $employeeId,
  //     'birth_date' => request('birth_date'),
  //     'gender' => request('gender'),
  //     'nationality' => request('nationality'),
  //     'citizenship' => request('citizenship'),
  //     'address' => request('address'),
  //     'email' => request('email'),
  //     'tel_1' => request('tel_1'),
  //     'tel_2' => request('tel_2'),
  //     'family_status' => request('family_status'),
  //     'children' => request('children'),
  //   ]);

  //   return $personalData;
  // }

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

    DB::table('users')->where('id', $id)->update([
      'avatar' => $avatar
    ]);

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

  public function educations($employeeId)
  {
    return Education::where('user_id', $employeeId)->get();
  }

  public function activities($employeeId)
  {
    return LaborActivity::where('user_id', $employeeId)->get();
  }

  public function storeEducation($employeeId)
  {
    request()->validate([
      'started_at' => 'required',
      'graduated_at' => 'required',
      'institution' => 'required',
      'faculty' => 'required',
      'form' => 'required',
      'speciality' => 'required',
    ]);

    return Education::create([
      'user_id' => $employeeId,
      'started_at' => request('started_at'),
      'graduated_at' => request('graduated_at'),
      'institution' => request('institution'),
      'faculty' => request('faculty'),
      'form' => request('form'),
      'speciality' => request('speciality'),
    ]);
  }

  public function storeActivity($employeeId)
  {
    request()->validate([
      'hired_at' => 'required',
      'dismissed_at' => 'required',
      'organization' => 'required',
      'job' => 'required',
    ]);

    return LaborActivity::create([
      'user_id' => $employeeId,
      'hired_at' => request('hired_at'),
      'dismissed_at' => request('dismissed_at'),
      'organization' => request('organization'),
      'job' => request('job'),
    ]);
  }

  public function updateLanguages($id)
  {
    $user = User::find($id);
    $languages = [];
    foreach (request('languages') as $language) {
      $languages[$language['id']] = ['level' => $language['level']];
    }
    $user->languages()->sync($languages);

    return User::detailed()->find($id);
  }
}
