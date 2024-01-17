<?php

use App\Http\Controllers\API\BookController;
use App\Http\Controllers\APILoginContoller;
use App\Http\Controllers\APIRegisterContoller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
//     return Auth()->user();
// });
Route::middleware('jwt.auth')->get('/user', function (Request $request) {
    return auth()->user();
});

Route::middleware('jwt.auth')->group(function (){
Route::get('book',[BookController::class,'index']);
Route::get('show',[BookController::class,'show']);

Route::post('update/{id}',[BookController::class,'update']);
Route::post('create',[BookController::class,'store']);

});

Route::post('register',[APIRegisterContoller::class,'register']);
Route::post('login',[APILoginContoller::class,'login']);
