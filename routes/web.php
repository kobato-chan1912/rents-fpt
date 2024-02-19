<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\laravel_example\UserManagement;
use \Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use \App\Http\Controllers\FeedbackController;
use App\Http\Controllers\CommentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get("/", function (){
  return view("index");
});

Route::get("/page-2.html", function (){
  return view("index2");
});

Route::get("/page-3.html", function (){
  return view("index3");
});

Route::get("/page-4.html", function (){
  return view("index4");
});


Route::get('/login', [AuthenticatedSessionController::class, 'create'])
  ->middleware('guest')
  ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
  ->middleware('guest');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
  \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::prefix("/admin")->middleware(['auth'])->group(function () {
  Route::get("/", function (){
    return view("admin.index");
  });

  Route::prefix("/")->middleware(['admin'])->group(function () {
    Route::get("/users", [\App\Http\Controllers\Admin\UserController::class, 'index'])->name("admin.users.index");
    Route::post("/users", [\App\Http\Controllers\Admin\UserController::class, 'create']);
    Route::post("/users/{id}", [\App\Http\Controllers\Admin\UserController::class, 'edit']);
    Route::delete("/users/{id}", [\App\Http\Controllers\Admin\UserController::class, 'delete']);


    Route::get("/cities", [\App\Http\Controllers\Admin\CityController::class, 'index'])->name("admin.cities.index");
    Route::post("/cities", [\App\Http\Controllers\Admin\CityController::class, 'create']);
    Route::post("/cities/{id}", [\App\Http\Controllers\Admin\CityController::class, 'edit']);
    Route::delete("cities/{id}", [\App\Http\Controllers\Admin\CityController::class, 'delete']);


  });



  Route::prefix("/")->middleware(['staff'])->group(function () {
    Route::get("/auctions", [\App\Http\Controllers\Admin\AuctionController::class, 'index'])->name("admin.auctions.index");
    Route::get("/auctions/create", [\App\Http\Controllers\Admin\AuctionController::class, 'createForm']);
    Route::post("/auctions", [\App\Http\Controllers\Admin\AuctionController::class, 'create']);
    Route::delete("/auctions/{id}", [\App\Http\Controllers\Admin\AuctionController::class, 'delete']);
    Route::get("/auctions/{id}", [\App\Http\Controllers\Admin\AuctionController::class, 'editForm']);
    Route::post("/auctions/{id}", [\App\Http\Controllers\Admin\AuctionController::class, 'edit']);

  });





});



