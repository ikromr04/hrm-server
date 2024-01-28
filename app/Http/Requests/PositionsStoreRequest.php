<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PositionsStoreRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'title' => 'required|unique:positions,title',
    ];
  }

  public function messages()
  {
    return [
      'title.required' => 'Поле обязательно для заполнения.',
      'title.unique' => 'Позиция с таким названием уже существует.',
    ];
  }
}
