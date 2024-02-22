<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentsUpdateRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    $rules = [];
    $this->has('title') && $rules = array_merge($rules, ['title' => 'required|unique:departments,title']);

    return $rules;
  }

  public function messages()
  {
    return [
      'title.required' => 'Поле обязательно для заполнения.',
      'title.unique' => 'Отдел/департамент с таким названием уже существует.',
    ];
  }
}
