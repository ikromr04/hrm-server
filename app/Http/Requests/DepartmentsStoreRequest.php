<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentsStoreRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'title' => 'required|unique:departments,title',
    ];
  }

  public function messages()
  {
    return [
      'title.required' => 'Поле обязательно для заполнения.',
      'title.unique' => 'Отдел с таким названием уже существует.',
    ];
  }
}
