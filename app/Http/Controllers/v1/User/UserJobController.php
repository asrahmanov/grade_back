<?php

namespace App\Http\Controllers\v1\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\v1\Response\ResponseController;
use App\Models\JobGroups;
use App\Models\User;
use App\Models\UserRegularJobs;
use Illuminate\Http\Request;

class UserJobController extends ResponseController
{
    public function getJob(Request $request)
    {
        $user = $request->user();
        $regularJob = UserRegularJobs::query()->where('user_id', $user->id)->first();
        $job = JobGroups::query()->where('id', $regularJob->job_parent_id)->join('job_items','job_items.id', '=' , $regularJob->job_item_id)->get();
        return $this->sendResponse($job, 'Операция успешна', 200);
    }

    public function getUserJobGroup(Request $request)
    {
        $user = $request->user();
        $regularJob = UserRegularJobs::query()->where('user_id', $user->id)->first();
        $ids = UserRegularJobs::query()->where('job_group_id' , $regularJob->job_group_id)->get(['user_id']);
        $users =  User::whereIn('id' , $ids)->get();
        $job = JobGroups::where('id' , $regularJob['job_group_id'])->first();
        return $this->sendResponse(['users' => $users , 'job' => $job], 'Операция успешна', 200);
    }
}
