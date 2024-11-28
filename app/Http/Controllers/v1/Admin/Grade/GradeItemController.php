<?php

namespace App\Http\Controllers\v1\Admin\Grade;

use App\Http\Controllers\Controller;
use App\Http\Controllers\v1\Response\ResponseController;
use App\Models\GradeItems;
use Illuminate\Http\Request;

class GradeItemController extends ResponseController
{
    public function create(Request $request)
    {
        $data = GradeItems::create($request->title , $request->grade_parent_id);
        return $this->sendResponse($data, 'Операция успешна', 200);
    }

    public function update(Request $request)
    {
        $data = GradeItems::updateGrade($request);
        return $this->sendResponse($data, 'Операция успешна', 200);
    }

    public function delete(Request $request)
    {
        $data = GradeItems::deleteGrade($request);
        return $this->sendResponse($data, 'Операция успешна', 200);
    }

    public function getListItems(Request $request)
    {
        $data = GradeItems::getListItems($request->grade_parent_id);
        return $this->sendResponse($data, 'Операция успешна', 200);
    }

    public function deleteItem(Request $request)
    {
        $data = GradeItems::deleteItem($request->id);
        return $this->sendResponse($data, 'Операция успешна', 200);
    }
}
