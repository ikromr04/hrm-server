<?php

namespace App\Http\Controllers;

use App\Http\Requests\EducationsStoreRequest;
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
}
