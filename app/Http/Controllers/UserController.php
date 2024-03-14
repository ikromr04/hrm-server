<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeStoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Activity;
use App\Models\Detail;
use App\Models\Education;
use DateTime;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Date;

class UserController extends Controller
{
  public function index()
  {
    $users = User::orderBy('surname')
      ->select(
        'id',
        'name',
        'surname',
        'patronymic',
        'login',
        'avatar',
        'avatar_thumb as avatarThumb',
        'started_work_at as startedWorkAt',
        'role_id',
      )
      ->with([
        'role' => function ($query) {
          $query->select(
            'id',
            'name',
            'display_name as displayName'
          );
        },
        'details' => function ($query) {
          $query->select(
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
        },
        'departments' => function ($query) {
          $query->select(
            'id',
            'title',
          );
        },
        'jobs' => function ($query) {
          $query->select(
            'id',
            'title',
          );
        },
        'positions' => function ($query) {
          $query->select(
            'id',
            'title',
          );
        },
        'languages' => function ($query) {
          $query->select(
            'id',
            'name',
          );
        },
      ])
      ->get();

    foreach ($users as $user) {
      $user->avatar && $user->avatar = asset($user->avatar);
      $user->avatarThumb && $user->avatarThumb = asset($user->avatarThumb);

      foreach ($user->languages as $language) {
        $language->level = $language->pivot->level;
        unset($language->pivot);
      }

      unset($user->role_id);
      unset($user->details->user_id);
    }

    return response($users, 200);
  }

  public function show($id)
  {
    $user = UserController::getClientUser($id);

    return response($user, 200);
  }

  public function store(EmployeeStoreRequest $request)
  {
    $user = User::create([
      'name' => $request->name,
      'surname' => $request->surname,
      'patronymic' => $request->patronymic,
      'login' => $request->login,
      'password' => Crypt::encryptString(Str::random(8)),
      'started_work_at' => $request->started_work_at
        ? $request->started_work_at
        : date('Y-m-d H:i:s'),
    ]);

    $user->details()->create([
      'user_id' => $user->id,
      'birth_date' => $request->input('details.birth_date'),
      'gender' => $request->input('details.gender'),
      'nationality' => $request->input('details.nationality'),
      'citizenship' => $request->input('details.citizenship'),
      'address' => $request->input('details.address'),
      'email' => $request->input('details.email'),
      'tel_1' => $request->input('details.tel_1'),
      'tel_2' => $request->input('details.tel_2'),
      'family_status' => $request->input('details.family_status'),
      'children' => $request->input('details.children'),
    ]);

    $request->has('jobs')
      && $user->jobs()->sync($request->jobs);
    $request->has('positions')
      && $user->positions()->sync($request->positions);
    $request->has('departments')
      && $user->departments()->sync($request->departments);

    return response(UserController::getClientUser($user->id), 201);
  }

  public function update(EmployeeUpdateRequest $request, $id)
  {
    $user = User::find($id);
    $request->has('name')
      && $user->name = $request->input('name');
    $request->has('surname')
      && $user->surname = $request->input('surname');
    $request->has('patronymic')
      && $user->patronymic = $request->input('patronymic');
    $request->has('login')
      && $user->login = $request->input('login');
    $request->has('started_work_at')
      && $user->started_work_at = $request->input('started_work_at');
    $user->isDirty()
      && $user->update();

    if ($request->has('details')) {
      $detail = Detail::where('user_id', $user->id)
        ->first();
      $request->has('details.birth_date')
        && $detail->birth_date = $request->input('details.birth_date');
      $request->has('details.gender')
        && $detail->gender = $request->input('details.gender');
      $request->has('details.nationality')
        && $detail->nationality = $request->input('details.nationality');
      $request->has('details.citizenship')
        && $detail->citizenship = $request->input('details.citizenship');
      $request->has('details.address')
        && $detail->address = $request->input('details.address');
      $request->has('details.email')
        && $detail->email = $request->input('details.email');
      $request->has('details.tel_1')
        && $detail->tel_1 = $request->input('details.tel_1');
      $request->has('details.tel_2')
        && $detail->tel_2 = $request->input('details.tel_2');
      $request->has('details.family_status')
        && $detail->family_status = $request->input('details.family_status');
      $request->has('details.children')
        && $detail->children = $request->input('details.children');
      $detail->save();
    }

    $request->has('departments')
      && $user->departments()->sync($request->departments);
    $request->has('jobs')
      && $user->jobs()->sync($request->jobs);
    $request->has('positions')
      && $user->positions()->sync($request->positions);

    if ($request->has('languages')) {
      $languages = [];
      foreach ($request->input('languages') as $language) {
        $languages[$language['id']] = ['level' => $language['level']];
      }
      $user->languages()->sync($languages);
    }

    return response(UserController::getClientUser($id), 200);
  }

  public function updateAvatar($id)
  {
    $user = DB::table('users')->find($id);

    if ($user->avatar && file_exists(public_path($user->avatar))) {
      unlink(public_path($user->avatar));
    }
    if ($user->avatar_thumb && file_exists(public_path($user->avatar_thumb))) {
      unlink(public_path($user->avatar_thumb));
    }

    $avatar = request()->file('avatar');
    $avatarThumb = Image::make($avatar);
    $avatarThumb->resize(144, 144, function ($constraint) {
      $constraint->aspectRatio();
    });
    $avatarName = uniqid() . '.' . $avatar->extension();
    $avatarPath = 'uploads/img/employees/' . $avatarName;
    $avatarThumbPath = 'uploads/img/employees/thumbs/' . uniqid() . '.' . $avatar->extension();
    $avatarThumb->save($avatarThumbPath);
    $avatar->move(public_path('/uploads/img/employees'), $avatarName);

    DB::table('users')->where('id', $id)->update([
      'avatar' => $avatarPath,
      'avatar_thumb' => $avatarThumbPath,
    ]);

    return response([
      'avatar' => asset($avatarPath),
      'avatarThumb' => asset($avatarThumbPath),
    ], 200);
  }

  public function deleteAvatar($id)
  {
    $user = DB::table('users')->find($id);

    if ($user->avatar && file_exists(public_path($user->avatar))) {
      unlink(public_path($user->avatar));
      $user->avatar = '';
    }
    if ($user->avatar_thumb && file_exists(public_path($user->avatar_thumb))) {
      unlink(public_path($user->avatar_thumb));
      $user->avatar_thumb = '';
    }

    DB::table('users')->where('id', $id)->update([
      'avatar' => '',
      'avatar_thumb' => '',
    ]);

    return response()->noContent();
  }

  public function educations($id)
  {
    $educations = Education::select(
      'id',
      'user_id as userId',
      'started_at as startedAt',
      'graduated_at as graduatedAt',
      'institution',
      'faculty',
      'form',
      'speciality'
    )
      ->where('user_id', $id)
      ->orderBy('started_at', 'desc')
      ->get();

    return response($educations, 200);
  }

  public function activities($id)
  {
    $activities = Activity::select(
      'id',
      'user_id as userId',
      'organization',
      'job',
      'hired_at as hiredAt',
      'dismissed_at as dismissedAt'
    )
      ->where('user_id', $id)
      ->orderBy('hired_at', 'desc')
      ->get();

    return response($activities, 200);
  }

  public static function getClientUser($id)
  {
    $user = User::select(
      'id',
      'name',
      'surname',
      'patronymic',
      'login',
      'avatar',
      'avatar_thumb as avatarThumb',
      'started_work_at as startedWorkAt',
      'role_id',
    )
      ->with([
        'role' => function ($query) {
          $query->select(
            'id',
            'name',
            'display_name as displayName'
          );
        },
        'details' => function ($query) {
          $query->select(
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
        },
        'departments' => function ($query) {
          $query->select(
            'id',
            'title',
          );
        },
        'jobs' => function ($query) {
          $query->select(
            'id',
            'title',
          );
        },
        'positions' => function ($query) {
          $query->select(
            'id',
            'title',
          );
        },
        'languages' => function ($query) {
          $query->select(
            'id',
            'name',
          );
        },
      ])
      ->find($id);

    $user->avatar && $user->avatar = asset($user->avatar);
    $user->avatarThumb && $user->avatarThumb = asset($user->avatarThumb);

    foreach ($user->languages as $language) {
      $language->level = $language->pivot->level;
      unset($language->pivot);
    }

    $prevId = User::where('id', '<', $user->id)->max('id');
    if (!$prevId) {
      $prevId = User::orderBy('id', 'desc')->first()->id;
    }
    $user->previous = $prevId;

    $nextId = User::where('id', '>', $user->id)->min('id');
    if (!$nextId) {
      $nextId = User::orderBy('id', 'asc')->first()->id;
    }
    $user->next = $nextId;

    unset($user->role_id);
    unset($user->details->user_id);

    return $user;
  }
}
