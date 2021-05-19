<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProjectController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return Auth()->user();
});
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::post('/edituser', [UserController::class, 'update']);
    Route::get('/activeproject', [ProjectController::class, 'showactiveproject']);
    Route::get('/onprogressproject', [ProjectController::class, 'showonprogressproject']);
    Route::get('/doneproject', [ProjectController::class, 'showdoneproject']);
    Route::post('/getusername', [UserController::class, 'getusername']);
});
Route::group(['middleware' => ['auth:sanctum', 'admin']], function () {
    Route::post('/showalluser', [AdminController::class, 'showalluser']);
    Route::post('/createProject', [AdminController::class, 'createProject']);
    Route::post('/updateProject', [AdminController::class, 'updateProject']);
    Route::post('/deleteProject', [AdminController::class, 'deleteProject']);
    Route::post('/showbidproject', [AdminController::class, 'showBidproject']);
    Route::post('/showallbid', [AdminController::class, 'showallBid']);
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/deleteuser', [UserController::class, 'deleteuser']);
});
Route::group(['middleware' => ['auth:sanctum', 'teknisi']], function () {
    Route::post('/createBid', [ProjectController::class, 'createBid']);
    Route::post('/deleteBid', [ProjectController::class, 'deleteBid']);
    Route::post('/updateBid', [ProjectController::class, 'updateBid']);
});
Route::post('/login', [UserController::class, 'login']);
