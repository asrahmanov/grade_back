<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\v1\Response\ResponseController;
use App\Models\JobGroups;
use App\Models\JobItems;
use App\Models\User;
use App\Models\UserGrades;
use App\Models\UserRegularJobs;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class JobItemsController extends ResponseController
{
    public function create(Request $request)
    {
        $job = JobItems::query()->create([
            'job_parent_id' => $request->job_parent_id,
            'name' => $request->name
        ]);
        return $this->sendResponse($job, 'Операция успешна', 200);
    }

    public function createGroup(Request $request)
    {
        $job = JobGroups::query()->create([
            'name' => $request->name
        ]);
        return $this->sendResponse($job, 'Операция успешна', 200);
    }

    public function update(Request $request)
    {
        $job = JobItems::query()->where('id' , $request->id)->update($request->all());
        return $this->sendResponse($job, 'Операция успешна', 200);
    }

    public function updateUserGroup(Request $request)
    {
        $job = UserRegularJobs::query()->where('user_id' , $request->user_id)->updateOrCreate(['user_id' => $request->user_id],['job_group_id' => $request->job_group_id]);
        return $this->sendResponse($job, 'Операция успешна', 200);
    }

    public function getByGroupId(Request $request)
    {
        $job = JobItems::query()->where('job_parent_id' , $request->job_parent_id)->get();
        return $this->sendResponse($job, 'Операция успешна', 200);
    }

    public function updateOrCreateForUser(Request $request)
    {
        $user = UserRegularJobs::query()->updateOrCreate(
            ['user_id' => $request->user_id] ,
            ['job_group_id' => $request->job_group_id , 'job_item_id' => $request->job_item_id]
        );
        return $this->sendResponse($user, 'Операция успешна', 200);
    }

    public function getGroupsWithUsers(Request $request)
    {
        $users = User::select('users.*', 'job_groups.id as group_id', 'job_groups.name as group_name')
            ->join('user_regular_jobs', 'users.id', '=', 'user_regular_jobs.user_id')
            ->join('job_groups', 'user_regular_jobs.job_group_id', '=', 'job_groups.id')
            ->get();

        $jobGroups = JobGroups::all();

        $groupedJobs = $jobGroups->keyBy('id')->map(function ($group) {
            return [
                'id' => $group->id,
                'name' => $group->name,
                'users' => new Collection()
            ];
        });

        foreach ($users as $user) {
            if ($groupedJobs->has($user->group_id)) {
                $groupedJobs->get($user->group_id)['users']->push([
                    'id' => $user->id,
                    'email' => $user->email,
                    'fullname' => $user->fullname,
                    'job_title' => $user->job_title,
                ]);
            }
        }

        $finalJobsArray = $groupedJobs->values()->all();

        return $this->sendResponse(['job' => $finalJobsArray], 'Операция успешна', 200);
    }

    public function updateOrCreateAppointment(Request $request)
    {
        $data = $request->all();
        foreach ($data as $datum)
        {
            UserGrades::query()->updateOrCreate(['user_id' => $datum['user_id'] ,'grade_parent_id' => $datum['grade_parent_id'] ,'grade_id' => $datum['grade_id'] ?? NULL]);
        }
    }
}
