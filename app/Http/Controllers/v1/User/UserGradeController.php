<?php

namespace App\Http\Controllers\v1\User;

use App\Http\Controllers\v1\Response\ResponseController;
use App\Models\Grade;
use App\Models\GradeItems;
use App\Models\UserGrades;
use Illuminate\Http\Request;

class UserGradeController extends ResponseController
{
    public function get(Request $request)
    {
        $data = UserGrades::get($request->user()->id);
        return $this->sendResponse($data, 'Операция успешна', 200);
    }

    public function getById(Request $request)
    {
        $data = GradeItems::getListItems($request->grade_parent_id);
        return $this->sendResponse($data, 'Операция успешна', 200);
    }

}
