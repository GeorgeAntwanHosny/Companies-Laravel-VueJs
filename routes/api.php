<?php

use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Auth\Passport\AuthUserController;
use App\Http\Controllers\Auth\Passport\utilitsFunController;
use App\Models\User;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('companies', CompanyController::class);


Route::get('/login', function () {
    return response()->json(['message'=>'you aren\'t authorized to do this action. please, login'],401);
})->name('login');

Route::post('/auth/register',[AuthUserController::class,'registerUser']);
Route::post('/auth/login',[AuthUserController::class,'loginUser']);
Route::get('/auth/logout',[AuthUserController::class,'logout'])->middleware('auth:api');

Route::get('/users',function (){
    return response()->json(['users'=>User::all()],200);
});





