<?php

use App\Http\Controllers\TaskController;
use App\Models\Task;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/test', function(){
//     echo 'Hola Mundo';
// });
// Route::apiResource('tasks', TaskControllerr::class);

Route::get('/tasks',    [TaskController::class, 'index']);
Route::post('/tasks',   [TaskController::class, 'store']);
Route::get('/tasks/{id}',   [TaskController::class, 'show']);
Route::put('/tasks/{id}',   [TaskController::class, 'update']);
Route::delete('/tasks/{id}',   [TaskController::class, 'destroy']);

// https://www.youtube.com/watch?v=ZOZNJqpiiL0