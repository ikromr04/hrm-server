<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquipmentsStoreRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'user_id' => 'required',
      'title' => 'required',
    ];
  }

  public function messages()
  {
    return [
      'user_id.required' => 'id сотрудника обязательно для заполнения.',
      'title.required' => 'Это поле обязательно для заполнения.',
    ];
  }
}
