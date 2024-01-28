<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobsStoreRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'title' => 'required|unique:jobs,title',
    ];
  }

  public function messages()
  {
    return [
      'title.required' => 'Поле обязательно для заполнения.',
      'title.unique' => 'Должность с таким названием уже существует.',
    ];
  }
}
