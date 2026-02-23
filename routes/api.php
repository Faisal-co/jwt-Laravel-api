<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ApiJwtController;
// register & login are open routes So, no Need of Token.
Route::post('register', [ApiJwtController::class, 'register']);
Route::post('login', [ApiJwtController::class, 'login']);
// profile, refresh & logout are Protected routes So, Need of Token.
Route::group(['middleware'=>'auth:api'], function(){
    Route::get('profile', [ApiJwtController::class, 'profile']);
    Route::get('refreshToken', [ApiJwtController::class, 'refreshToken']);
    Route::get('logout', [ApiJwtController::class, 'logout']);

    

});


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
