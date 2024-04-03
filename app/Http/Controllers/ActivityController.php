<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivitiesStoreRequest;
use App\Http\Requests\ActivitiesUpdateRequest;
use App\Models\Activity;

class ActivityController extends Controller
{
  public function store(ActivitiesStoreRequest $request)
  {
    $activity = Activity::create([
      'user_id' => $request->input('user_id'),
      'organization' => $request->input('organization'),
      'job' => $request->input('job'),
      'hired_at' => $request->input('hired_at'),
      'dismissed_at' => $request->input('dismissed_at'),
    ]);

    return response(Activity::find($activity->id), 200);
  }

  public function update(ActivitiesUpdateRequest $request, $id)
  {
    $activity = Activity::find($id);
    $request->has('organization')
      && $activity->organization = $request->input('organization');
    $request->has('job')
      && $activity->job = $request->input('job');
    $request->has('hired_at')
      && $activity->hired_at = $request->input('hired_at');
    $request->has('dismissed_at')
      && $activity->dismissed_at = $request->input('dismissed_at');
    $activity->isDirty()
      && $activity->update();

    return response(Activity::find($id), 200);
  }

  public function delete($id)
  {
    Activity::find($id)->delete();

    return response(['message' => 'Данные удалены.'], 204);
  }
}
