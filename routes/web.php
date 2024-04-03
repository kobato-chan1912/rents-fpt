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

Route::get("/", [\App\Http\Controllers\Webpage\HomeController::class, 'index'])->name("home");
Route::get("filter", [\App\Http\Controllers\Webpage\HomeController::class, 'filter'])->name("filter");
Route::get("/auction/checkRemain", [\App\Http\Controllers\Webpage\AuctionController::class, 'checkRemain']);
Route::get("/auction/checkRegister", [\App\Http\Controllers\Webpage\AuctionController::class, 'checkRegister']);
Route::get("/auction/buy_now", [\App\Http\Controllers\Webpage\AuctionController::class, 'checkBuyNow']);
Route::get("/auction/{id}", [\App\Http\Controllers\Webpage\AuctionController::class, 'index'])->name("auction_detail");
Route::get("/auction/{id}/bid", [\App\Http\Controllers\Webpage\AuctionController::class, 'bid'])->name("bid")->middleware(["auth", "user"]);
Route::get("/auction/{id}/buy", [\App\Http\Controllers\Webpage\AuctionController::class, 'addBuyNow'])->name("bid")->middleware(["auth", "user"]);
Route::post("/auction/{id}/feedback", [\App\Http\Controllers\Webpage\AuctionController::class, 'addFeedback'])->middleware(["auth", "user"]);;
Route::post("/auction/{id}/register", [\App\Http\Controllers\Webpage\AuctionController::class, 'register'])->middleware(["auth", "user"]);;
Route::post("/auction/{id}/addBid", [\App\Http\Controllers\Webpage\AuctionController::class, 'addBid'])->middleware(["auth", "user"]);
Route::post("/auction/{id}/addAutoBid", [\App\Http\Controllers\Webpage\AuctionController::class, 'addAutoBid'])->middleware(["auth", "user"]);
Route::get("/auction/{id}/bid/{bidId}/payRemain", [\App\Http\Controllers\Webpage\AuctionController::class, 'donePay'])->middleware(["auth", "user"]);;
Route::get("/user/historyBid", [\App\Http\Controllers\Webpage\UserController::class, 'historyBid'])->middleware(["auth", "user"]);;
Route::get("/user/historyBuy", [\App\Http\Controllers\Webpage\UserController::class, 'historyBuy'])->middleware(["auth", "user"]);;
Route::get("/auction/{id}/cancelAuto", [\App\Http\Controllers\Webpage\AuctionController::class, 'cancelAuto']);

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
  ->middleware('guest')
  ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
  ->middleware('guest');



Route::get("/dang-ky", [\App\Http\Controllers\Webpage\RegisterController::class, 'index']);
Route::post("/dang-ky", [\App\Http\Controllers\Webpage\RegisterController::class, 'register']);

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
  \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::prefix("/admin")->middleware(['auth'])->group(function () {
  Route::get("/", function () {
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

    Route::get("/feedback", [\App\Http\Controllers\Admin\FeedbackController::class, 'index'])->name("admin.feedback.index");
    Route::post("/feedback/{id}/updateShow", [\App\Http\Controllers\Admin\FeedbackController::class, 'updateShow']);



  });


  Route::prefix("/")->middleware(['staff'])->group(function () {
    Route::get("/auctions", [\App\Http\Controllers\Admin\AuctionController::class, 'index'])->name("admin.auctions.index");
    Route::get("/auctions/create", [\App\Http\Controllers\Admin\AuctionController::class, 'createForm']);
    Route::delete("/auctions/{id}", [\App\Http\Controllers\Admin\AuctionController::class, 'delete']);
    Route::get("/auctions/{id}", [\App\Http\Controllers\Admin\AuctionController::class, 'editForm']);
    Route::post("/auctions/{id}", [\App\Http\Controllers\Admin\AuctionController::class, 'edit']);
    Route::post("/auctions/{id}/reset", [\App\Http\Controllers\Admin\AuctionController::class, 'resetAuction']);


    Route::get("/real_estate", [\App\Http\Controllers\Admin\RealEstateController::class, 'index'])->name("admin.real_estate.index");
    Route::post("/real_estate", [\App\Http\Controllers\Admin\RealEstateController::class, 'create']);
    Route::get("/real_estate/create", [\App\Http\Controllers\Admin\RealEstateController::class, 'createForm']);
    Route::get("/real_estate/{id}", [\App\Http\Controllers\Admin\RealEstateController::class, 'editForm']);
    Route::post("/real_estate/{id}", [\App\Http\Controllers\Admin\RealEstateController::class, 'edit']);

  });


});



