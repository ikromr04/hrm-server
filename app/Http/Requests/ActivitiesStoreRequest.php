<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivitiesStoreRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'user_id' => 'required',
      'organization' => 'required',
      'job' => 'required',
      'hired_at' => 'required|date',
      'dismissed_at' => 'required|date',
    ];
  }

  public function messages()
  {
    return [
      'user_id.required' => 'id сотрудника обязательно для заполнения.',
      'organization.required' => 'Это поле обязательно для заполнения.',
      'job.required' => 'Это поле обязательно для заполнения.',
      'hired_at.required' => 'Это поле обязательно для заполнения.',
      'hired_at.date' => 'Поле не является допустимой датой.',
      'dismissed_at.required' => 'Это поле обязательно для заполнения.',
      'dismissed_at.date' => 'Поле не является допустимой датой.',
    ];
  }
}
