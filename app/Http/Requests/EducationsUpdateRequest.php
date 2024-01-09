<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationsUpdateRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    $rules = [];
    $this->has('institution') && $rules = array_merge($rules, ['institution' => 'required']);
    $this->has('faculty') && $rules = array_merge($rules, ['faculty' => 'required']);
    $this->has('speciality') && $rules = array_merge($rules, ['speciality' => 'required']);
    $this->has('form') && $rules = array_merge($rules, ['form' => 'required']);
    $this->has('started_at') && $rules = array_merge($rules, ['started_at' => 'required|date']);
    $this->has('graduated_at') && $rules = array_merge($rules, ['graduated_at' => 'required|date']);

    return $rules;
  }

  public function messages()
  {
    return [
      'institution.required' => 'Укажите учебное заведение.',
      'faculty.required' => 'Поле факультет обязательно для заполнения.',
      'speciality.required' => 'Поле специальность обязательно для заполнения.',
      'form.required' => 'Укажите форму обучения.',
      'started_at.required' => 'Это поле обязательно для заполнения.',
      'started_at.date' => 'Поле \'год поступления\' не является допустимой датой.',
      'graduated_at.required' => 'Это поле обязательно для заполнения.',
      'graduated_at.date' => 'Поле \'год окончания\' не является допустимой датой.',
    ];
  }
}
