<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionsStoreRequest;
use App\Http\Requests\PositionsUpdateRequest;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
  public function index()
  {
    $positions = Position::get();

    return response($positions, 200);
  }

  public function store(PositionsStoreRequest $request)
  {
    $position = new Position();
    $position->title = $request->input('title');
    $position->save();

    return response($position, 201);
  }

  public function update(PositionsUpdateRequest $request, $id)
  {
    $position = Position::find($id);
    $position->title = $request->input('title');
    $position->update();

    return response($position, 200);
  }

  public function delete($id)
  {
    Position::find($id)->delete();

    return response()->noContent();
  }
}
