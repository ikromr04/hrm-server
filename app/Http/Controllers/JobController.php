<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobsStoreRequest;
use App\Http\Requests\JobsUpdateRequest;
use App\Models\Job;

class JobController extends Controller
{
  public function index()
  {
    $jobs = Job::get();

    return response($jobs, 200);
  }

  public function store(JobsStoreRequest $request)
  {
    $job = new Job();
    $job->title = $request->input('title');
    $job->save();

    return response($job, 201);
  }

  public function update(JobsUpdateRequest $request, $id)
  {
    $job = Job::find($id);
    $job->title = $request->input('title');
    $job->update();

    return response($job, 200);
  }

  public function delete($id)
  {
    Job::find($id)->delete();

    return response()->noContent();
  }
}
