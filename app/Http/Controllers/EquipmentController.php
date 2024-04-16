<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipmentsStoreRequest;
use App\Http\Requests\EquipmentsUpdateRequest;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
  public function store(EquipmentsStoreRequest $request)
  {
    $equipment = Equipment::create([
      'user_id' => $request->input('user_id'),
      'title' => $request->input('title'),
      'info' => $request->input('info'),
    ]);

    return response([
      'id' => $equipment->id,
      'user_id' => $equipment->user_id,
      'title' => $equipment->title,
      'info' => $equipment->info,
    ], 200);
  }

  public function update(EquipmentsUpdateRequest $request, $id)
  {
    $equipment = Equipment::select('id', 'user_id', 'title', 'info')->find($id);
    $request->has('title')
      && $equipment->title = $request->input('title');
    $request->has('info')
      && $equipment->info = $request->input('info');
    $equipment->isDirty()
      && $equipment->update();

    return response($equipment, 200);
  }

  public function delete($id)
  {
    Equipment::find($id)->delete();

    return response(['message' => 'Данные удалены.'], 204);
  }
}
