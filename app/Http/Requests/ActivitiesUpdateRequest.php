<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivitiesUpdateRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    $rules = [];
    $this->has('organization') && $rules = array_merge($rules, ['organization' => 'required']);
    $this->has('job') && $rules = array_merge($rules, ['job' => 'required']);
    $this->has('hired_at') && $rules = array_merge($rules, ['hired_at' => 'required|date']);
    $this->has('dismissed_at') && $rules = array_merge($rules, ['dismissed_at' => 'required|date']);

    return $rules;
  }

  public function messages()
  {
    return [
      'organization.required' => 'Это поле обязательно для заполнения.',
      'job.required' => 'Это поле обязательно для заполнения.',
      'hired_at.required' => 'Это поле обязательно для заполнения.',
      'hired_at.date' => 'Поле не является допустимой датой.',
      'dismissed_at.required' => 'Это поле обязательно для заполнения.',
      'dismissed_at.date' => 'Поле не является допустимой датой.',
    ];
  }
}
