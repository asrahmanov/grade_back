<?php

use App\Http\Controllers\v1\Admin\Grade\GradeController;
use App\Http\Controllers\v1\Admin\Grade\GradeItemController;
use App\Http\Controllers\v1\Admin\Grade\GradeStatusController;
use App\Http\Controllers\v1\Admin\JobGroupController;
use App\Http\Controllers\v1\Admin\JobItemsController;
use App\Http\Controllers\v1\AuthController;
use App\Http\Controllers\v1\User\UserGradeController;
use App\Http\Controllers\v1\User\UserInfoController;
use App\Http\Controllers\v1\User\UserJobController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::controller(AuthController::class)->group(function(){
    Route::post('login', 'login');
});
Route::middleware('auth:sanctum')->group( function () {
    Route::group([
        'prefix' => 'user',
    ], function () {
        Route::controller(UserInfoController::class)->group(function () {
            Route::get('get', 'info');
        });
        Route::group([
            'prefix' => 'grade',
        ], function () {
            Route::controller(UserGradeController::class)->group(function () {
                Route::get('get', 'get');
                Route::get('getById', 'getById');
            });
        });
        Route::group([
            'prefix' => 'job',
        ], function () {
            Route::controller(UserJobController::class)->group(function () {
                Route::get('getGroup', 'getUserJobGroup');
            });
        });
    });
});
Route::middleware(['auth:sanctum' , 'ability:admin'])->group( function () {
    Route::group([
        'prefix' => 'grade',
    ], function () {
        Route::controller(GradeController::class)->group(function () {
            Route::post('create', 'create');
            Route::get('getList', 'getList');
            Route::delete('delete' , 'deleteParent');
            Route::post('update', 'update');
        });
        Route::group([
            'prefix' => 'item',
        ], function () {
            Route::controller(GradeItemController::class)->group(function () {
                Route::post('create', 'create');
                Route::get('getByParent', 'getListItems');
                Route::post('delete', 'deleteItem');
                Route::post('update', 'update');
            });
        });
        Route::group([
            'prefix' => 'jobs',
        ], function () {
            Route::controller(JobGroupController::class)->group(function () {
                Route::post('create', 'create');
                Route::get('getList', 'getList');
                Route::post('update', 'update');
            });
            Route::group([
                'prefix' => 'item',
            ], function () {
                Route::controller(JobItemsController::class)->group(function () {
                    Route::get('getByGroupId', 'getByGroupId');
                    Route::post('create', 'create');
                    Route::post('update', 'update');
                });
            });
            Route::group([
                'prefix' => 'group',
            ], function () {
                Route::controller(JobItemsController::class)->group(function () {
                    Route::get('getAll', 'getGroupsWithUsers');
                    Route::post('createGroup', 'createGroup');
                    Route::post('updateUserGroup', 'updateUserGroup');
                    Route::post('appointCompetence', 'updateOrCreateAppointment');
                });
            });
            Route::group([
                'prefix' => 'user',
            ], function () {
                Route::controller(JobItemsController::class)->group(function () {
                    Route::post('updateOrCreateForUser', 'updateOrCreateForUser');
                });
            });
        });
        Route::group([
            'prefix' => 'user',
        ], function () {
            Route::controller(GradeStatusController::class)->group(function () {
                Route::get('get', 'get');
                Route::post('create', 'create');
                Route::post('update', 'update');
                Route::post('status', 'status');
            });
        });
    });
});
