<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacationsUpdateRequest;
use App\Models\User;
use App\Models\Vacation;
use Illuminate\Http\Request;

class VacationController extends Controller
{
  public static function get()
  {
    $users = User::orderBy('surname')
      ->select(
        'id',
        'name',
        'surname',
        'patronymic',
        'avatar_thumb as avatarThumb',
      )->with([
        'vacations' => function ($query) {
          $query->select(
            'id',
            'user_id',
            'year',
            'month',
          );
        },
      ])->get();

    foreach ($users as $user) {
      $user->avatarThumb && $user->avatarThumb = asset($user->avatarThumb);

      $vacations = [];
      foreach ($user->vacations as $vacation) {
        array_push($vacations,  [
          'year' => $vacation->year,
          'month' => $vacation->month
        ]);
      }
      unset($user->vacations);
      $user->vacations = $vacations;
    }

    return response($users, 200);
  }

  public function update(VacationsUpdateRequest $request)
  {
    $vacation = Vacation::where('user_id', $request->user_id)
      ->where('year', $request->old_year)
      ->first();

    if (!$vacation) {
      Vacation::create([
        'user_id' => $request->user_id,
        'year' => $request->new_year,
        'month' => $request->new_month,
      ]);

      return VacationController::get();
    }

    if (!$request->new_year || !$request->new_month) {
      $vacation->delete();
    } else {
      $vacation->year = $request->new_year;
      $vacation->month = $request->new_month;
      $vacation->update();
    }

    return VacationController::get();
  }
}
