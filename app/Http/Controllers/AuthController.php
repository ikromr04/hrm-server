<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
  public function check()
  {
    if (!request()->user('sanctum')) {
      return response(['message' => 'Вы не авторизованы.'], 401);
    }

    return response(request()->user('sanctum'), 200);
  }

  public function login(LoginRequest $request)
  {
    $user = User::where('login', $request->login)->first();

    if (!$user) {
      throw ValidationException::withMessages([
        'login' => ['Пользователь с таким логином не найден.'],
      ]);
    }

    if ($request->password != Crypt::decryptString($user->password)) {
      throw ValidationException::withMessages([
        'password' => ['Неверный пароль.'],
      ]);
    }

    $user->token = $user->createToken('access_token', [$user->role->name])->plainTextToken;

    return response($user, 200);
  }

  public function logout()
  {
    if (!request()->user('sanctum')) {
      return response(['message' => 'Вы не авторизованы.'], 401);
    }
    request()->user('sanctum')->currentAccessToken()->delete();

    return response(['message' => 'Вы успешно вышли из системы!'], 200);
  }
}
