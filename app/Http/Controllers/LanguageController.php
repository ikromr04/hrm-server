<?php

namespace App\Http\Controllers;

use App\Http\Requests\LanguagesStoreRequest;
use App\Http\Requests\LanguagesUpdateRequest;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
  public function index()
  {
    $languages = Language::get();

    return response($languages, 200);
  }

  public function store(LanguagesStoreRequest $request)
  {
    $language = new Language();
    $language->name = $request->input('name');
    $language->save();

    return response($language, 201);
  }

  public function update(LanguagesUpdateRequest $request, $id)
  {
    $language = Language::find($id);
    $language->name = $request->input('name');
    $language->update();

    return response($language, 200);
  }

  public function delete($id)
  {
    Language::find($id)->delete();

    return response()->noContent();
  }
}
