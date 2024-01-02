<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'login' => 'required',
      'password' => 'required',
    ];
  }

  public function messages()
  {
    return [
      'login.required' => 'Поле логин обязательно для заполнения.',
      'password.required' => 'Пароль обязательно для заполнения.',
    ];
  }
}
