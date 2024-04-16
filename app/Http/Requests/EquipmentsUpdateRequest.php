<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquipmentsUpdateRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    $rules = [];
    $this->has('title') && $rules = array_merge($rules, ['title' => 'required']);

    return $rules;
  }

  public function messages()
  {
    return [
      'title.required' => 'Это поле обязательно для заполнения.',
    ];
  }
}
