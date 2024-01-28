<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguagesStoreRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'name' => 'required|unique:languages,name',
    ];
  }

  public function messages()
  {
    return [
      'name.required' => 'Поле обязательно для заполнения.',
      'name.unique' => 'Этот язык уже существует.',
    ];
  }
}
