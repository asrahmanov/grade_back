<?php

namespace App\Http\Controllers\v1\Admin\Grade;

use App\Http\Controllers\Controller;
use App\Http\Controllers\v1\Response\ResponseController;
use App\Models\Grade;
use App\Models\GradeItems;
use Illuminate\Http\Request;

class GradeController extends ResponseController
{
    public function getList(Request $request)
    {
        $data = Grade::getList();
        return $this->sendResponse($data, 'Операция успешна', 200);
    }

    public function create(Request $request)
    {
        $data = Grade::create($request->title);
        return $this->sendResponse($data, 'Операция успешна', 200);
    }

    public function delete(Request $request)
    {
        $data = Grade::deleteGrade($request);
        return $this->sendResponse($data, 'Операция успешна', 200);
    }

    public function update(Request $request)
    {
        $data = Grade::updateGrade($request);
        return $this->sendResponse($data, 'Операция успешна', 200);
    }

    public function deleteParent(Request $request)
    {
        $data = Grade::deleteParent($request->id);
        return $this->sendResponse($data, 'Операция успешна', 200);
    }

}
