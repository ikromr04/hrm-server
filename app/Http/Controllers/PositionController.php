<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionsStoreRequest;
use App\Http\Requests\PositionsUpdateRequest;
use App\Models\Position;

class PositionController extends Controller
{
  public function index()
  {
    $positions = Position::select(
      'id',
      'title',
    )
      ->orderBy('title')
      ->get();

    return response($positions, 200);
  }

  public function store(PositionsStoreRequest $request)
  {
    $position = Position::create([
      'title' => $request->input('title'),
    ]);

    return response([
      'id' => $position->id,
      'title' => $position->title,
    ], 201);
  }

  public function update(PositionsUpdateRequest $request, $id)
  {
    $position = Position::find($id);
    $position->title = $request->input('title');
    $position->update();

    return response([
      'id' => $position->id,
      'title' => $position->title,
    ], 200);
  }

  public function delete($id)
  {
    Position::find($id)->delete();

    return response()->noContent();
  }
}
