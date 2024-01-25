<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthStoreRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'name' => 'required',
      'surname' => 'required',
      'login' => 'required|unique:users,login',
    ];
  }

  public function messages()
  {
    return [
      'name.required' => 'Поле имя обязательно для заполнения.',
      'surname.required' => 'Поле фамилия обязательно для заполнения.',
      'login.required' => 'Поле логин обязательно для заполнения.',
      'login.unique' => 'Этот логин уже занят.',
    ];
  }
}
