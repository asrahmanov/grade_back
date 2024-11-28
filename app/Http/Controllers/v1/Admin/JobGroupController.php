<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\v1\Response\ResponseController;
use App\Models\JobGroups;
use Illuminate\Http\Request;

class JobGroupController extends ResponseController
{
    public function create(Request $request)
    {
        $job = JobGroups::query()->create([
            'name' => $request->name
         ]);
        return $this->sendResponse($job, 'Операция успешна', 200);
    }

    public function getList(Request $request)
    {
        $jobs = JobGroups::query()->get();
        return $this->sendResponse($jobs, 'Операция успешна', 200);
    }

    public function update(Request $request)
    {
        $job = JobGroups::query()->where('id' , $request->id)->update(['name' => $request->name]);
        return $this->sendResponse($job, 'Операция успешна', 200);
    }
}
