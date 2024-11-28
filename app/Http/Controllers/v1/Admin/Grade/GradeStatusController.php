<?php

namespace App\Http\Controllers\v1\Admin\Grade;

use App\Http\Controllers\Controller;
use App\Http\Controllers\v1\Response\ResponseController;
use App\Models\UserGrades;
use Illuminate\Http\Request;

class GradeStatusController extends ResponseController
{
    public function get(Request $request)
    {
        $data = UserGrades::get($request->user_id);
        return $this->sendResponse($data, 'Операция успешна', 200);
    }

    public function create(Request $request)
    {
        $data = UserGrades::create($request->user_id, $request->grade_parent_id);
        return $this->sendResponse($data, 'Операция успешна', 200);
    }

    public function update(Request $request)
    {
        $data = UserGrades::updateStatus($request->user_id,$request->grade_id, $request->status);
        return $this->sendResponse($data, 'Операция успешна', 200);
    }
}
