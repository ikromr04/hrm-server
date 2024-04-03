<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobsStoreRequest;
use App\Http\Requests\JobsUpdateRequest;
use App\Models\Job;

class JobController extends Controller
{
  public function index()
  {
    $jobs = Job::select(
      'id',
      'title',
    )
      ->orderBy('title')
      ->get();

    return response($jobs, 200);
  }

  public function store(JobsStoreRequest $request)
  {
    $job = Job::create([
      'title' => $request->input('title'),
    ]);

    return response([
      'id' => $job->id,
      'title' => $job->title,
    ], 201);
  }

  public function update(JobsUpdateRequest $request, $id)
  {
    $job = Job::find($id);
    $job->title = $request->input('title');
    $job->update();

    return response([
      'id' => $job->id,
      'title' => $job->title,
    ], 200);
  }

  public function delete($id)
  {
    Job::find($id)->delete();

    return response()->noContent();
  }
}
