<?php

namespace App\Http\Controllers;

use App\Http\Requests\EducationsStoreRequest;
use App\Http\Requests\EducationsUpdateRequest;
use App\Models\Education;

class EducationController extends Controller
{
  public function store(EducationsStoreRequest $request)
  {
    $education = Education::create([
      'user_id' => $request->input('user_id'),
      'institution' => $request->input('institution'),
      'faculty' => $request->input('faculty'),
      'speciality' => $request->input('speciality'),
      'form' => $request->input('form'),
      'started_at' => $request->input('started_at'),
      'graduated_at' => $request->input('graduated_at'),
    ]);

    return response(Education::find($education->id), 200);
  }

  public function update(EducationsUpdateRequest $request, $id)
  {
    $education = Education::withoutGlobalScopes()->find($id);
    $request->has('institution') && $education->institution = $request->input('institution');
    $request->has('faculty') && $education->faculty = $request->input('faculty');
    $request->has('speciality') && $education->speciality = $request->input('speciality');
    $request->has('form') && $education->form = $request->input('form');
    $request->has('started_at') && $education->started_at = $request->input('started_at');
    $request->has('graduated_at') && $education->graduated_at = $request->input('graduated_at');
    $education->isDirty() && $education->update();

    return response(Education::find($id), 200);
  }

  public function delete($id)
  {
    Education::find($id)->delete();

    return response('Образование удалено.', 204);
  }
}
