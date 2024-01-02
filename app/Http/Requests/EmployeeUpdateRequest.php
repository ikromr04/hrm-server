<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'name' => 'required',
      'surname' => 'required',
      'patronymic' => 'nullable',
      'login' => 'required',
      'started_work_at' => 'required|date',
      'jobs' => 'nullable|array',
      'positions' => 'nullable|array',
      'languages' => 'nullable|array',
      'languages.*.id' => 'required|distinct',
      'languages.*.level' => 'required',
      'details' => 'nullable',
      'details.birth_date' => 'nullable|date',
      'details.gender' => 'nullable',
      'details.nationality' => 'nullable',
      'details.citizenship' => 'nullable',
      'details.address' => 'nullable',
      'details.email' => 'nullable|email',
      'details.tel1' => 'nullable',
      'details.tel2' => 'nullable',
      'details.familyStatus' => 'nullable',
      'details.children' => 'nullable|array',
      'details.children.*' => 'required|date',
    ];
  }

  public function messages()
  {
    return [
      'name.required' => 'Поле имя обязательно для заполнения.',
      'surname.required' => 'Поле фамилия обязательно для заполнения.',
      'login.required' => 'Поле логин обязательно для заполнения.',
      'started_work_at.required' => 'Поле \'начало работы\' обязательно для заполнения.',
      'started_work_at.date' => 'Поле \'начало работы\' не является допустимой датой.',
      'jobs.array' => 'Поле должен содержать массив должностей.',
      'positions.array' => 'Поле должен содержать массив позиций.',
      'languages.array' => 'Поле должен содержать массив языков.',
      'languages.*.id.required' => 'Язык должен иметь идентификатор.',
      'languages.*.id.distinct' => 'Языки повторяются',
      'languages.*.level.required' => 'Уровень языка не определен.',
      'details.birth_date.date' => 'Дата рождения не является допустимой датой.',
      'details.email.email' => 'E-mail должен быть действительным адресом электронной почты.',
      'details.children.array' => 'Поле дети должен быть массивом.',
      'details.children.*.date' => 'Поле не является допустимой датой.',
    ];
  }
}
