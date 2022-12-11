<?php

use App\Http\Controllers\API\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['api','middleware' => ['json.response']], function () {

    Route::group(['middleware' => ['cors']], function () {

        Route::apiResource('todos', TodoController::class,
                ['names' => [
                    'index'   => 'todos',
                    'destroy' => 'todo.destroy',
                ],
                'except' => [
                    'deleted',
                ],
            ]);

    });

});
