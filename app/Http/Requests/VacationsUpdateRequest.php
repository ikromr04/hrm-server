<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacationsUpdateRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'user_id' => 'required',
      'old_year' => 'required',
      'old_month' => 'required',
    ];
  }

  public function messages()
  {
    return [
      'user_id.required' => 'Поле user_id обязательно для заполнения.',
      'old_year.required' => 'Поле old_year обязательно для заполнения.',
      'old_month.required' => 'Поле old_month обязательно для заполнения.',
    ];
  }
}
