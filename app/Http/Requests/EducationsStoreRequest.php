<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationsStoreRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'user_id' => 'required',
      'institution' => 'required',
      'faculty' => 'required',
      'speciality' => 'required',
      'form' => 'required',
      'started_at' => 'required|date',
      'graduated_at' => 'required|date',
    ];
  }

  public function messages()
  {
    return [
      'user_id.required' => 'id сотрудника обязательно для заполнения.',
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
