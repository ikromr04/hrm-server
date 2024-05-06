<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VacationController extends Controller
{
  public function get()
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
            'date',
          );
        },
      ])->get();

    foreach ($users as $user) {
      $user->avatarThumb && $user->avatarThumb = asset($user->avatarThumb);

      $vacations = [];
      foreach ($user->vacations as $vacation) {
        array_push($vacations,  $vacation->date);
      }
      unset($user->vacations);
      $user->vacations = $vacations;
    }

    return response($users, 200);
  }
}
