<?php

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
//Route::post("/test-antrua", function (\Illuminate\Http\Request  $request){
//  return response()->json(["challenge" => $request->get("challenge")]);
//});

Route::post("/test-antrua", [\App\Http\Controllers\LaunchController::class, 'update'] );
