<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\NotebookController;

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

// open routes
Route::post('/login',[AuthController::class, 'login']);
Route::post('/register',[AuthController::class, 'register']);


//secured routes

Route::group(

    ['middleware'=> ['auth:sanctum']],
    
    function () {
        //for notebook routes
        Route::apiResource('/notebook', NotebookController::class);
        //for notebook with pages
        Route::post('/notebooks/{notebook}/pages', [PageController::class, 'store']);
     
        //for specific page routes
        Route::apiResource('/notebooks/{notebook}/pages', PageController::class);
      
        Route::post('/logout',[AuthController::class, 'logout']);
    }

);
