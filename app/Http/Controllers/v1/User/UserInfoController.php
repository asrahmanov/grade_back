<?php

namespace App\Http\Controllers\v1\User;
use App\Http\Controllers\v1\Response\ResponseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserInfoController extends ResponseController
{
    public function info(Request $request)
    {
        $data = $request->user();
        return $this->sendResponse($data, 'Операция успешна', 200);
    }
}
