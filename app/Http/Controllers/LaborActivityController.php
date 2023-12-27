<?php

namespace App\Http\Controllers;

use App\Models\LaborActivity;
use Illuminate\Http\Request;

class LaborActivityController extends Controller
{
  public function update($activityId)
  {
    request()->validate([
      'hired_at' => 'required',
      'dismissed_at' => 'required',
      'organization' => 'required',
      'job' => 'required',
    ]);

    LaborActivity::find($activityId)->update([
      'hired_at' => request('hired_at'),
      'dismissed_at' => request('dismissed_at'),
      'organization' => request('organization'),
      'job' => request('job'),
    ]);

    return LaborActivity::find($activityId);
  }

  public function delete($activityId)
  {
    LaborActivity::find($activityId)->delete();
    return;
  }
}
