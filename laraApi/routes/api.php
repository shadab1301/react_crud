<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\UsersController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get("/users",[UsersController::class,"getusers"]);
Route::get("/edit",[UsersController::class,"editUser"]);
Route::post("/update",[UsersController::class,"updateUser"]);
Route::post("/add-user",[UsersController::class,"adduser"]);
Route::get("/delete-user",[UsersController::class,"deleteUser"]);
Route::post("/search-user",[UsersController::class,"searchUser"]);