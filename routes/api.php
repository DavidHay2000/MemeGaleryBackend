<?php

use App\Http\Controllers\GalleriesController;
use App\Http\Controllers\PhotosController;
use App\Http\Controllers\Users;
use App\Models\Galleries;
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

Route::apiResource('galleries', GalleriesController::class);
Route::apiResource('photos', PhotosController::class);
Route::apiResource('users', Users::class);
Route::post('/register', [Users::class,'register']);
Route::post('/login', [Users::class, 'login']);


Route::get('/galleries/{galleryId}/photos', [PhotosController::class, 'getPhotosByGallery']);
