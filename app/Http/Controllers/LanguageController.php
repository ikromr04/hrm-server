<?php

namespace App\Http\Controllers;

use App\Http\Requests\LanguagesStoreRequest;
use App\Http\Requests\LanguagesUpdateRequest;
use App\Models\Language;

class LanguageController extends Controller
{
  public function index()
  {
    $languages = Language::select(
      'id',
      'name',
    )
      ->orderBy('name')
      ->get();

    return response($languages, 200);
  }

  public function store(LanguagesStoreRequest $request)
  {
    $language = Language::create([
      'name' => $request->input('name'),
    ]);

    return response([
      'id' => $language->id,
      'name' => $language->name,
    ], 201);
  }

  public function update(LanguagesUpdateRequest $request, $id)
  {
    $language = Language::find($id);
    $language->name = $request->input('name');
    $language->update();

    return response([
      'id' => $language->id,
      'name' => $language->name,
    ], 200);
  }

  public function delete($id)
  {
    Language::find($id)->delete();

    return response()->noContent();
  }
}
