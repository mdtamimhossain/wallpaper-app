<?php

use App\Http\Controllers\applicationController;
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
Route::post('/add-category', [applicationController::class, 'addCategory']);
Route::post('/update-category-image', [applicationController::class, 'updateCategoryImage']);
Route::get('/get-category/{id}', [applicationController::class, 'getCategory']);
Route::get('/all-category/', [applicationController::class, 'allCategory']);
Route::post('/delete-category/{id}', [applicationController::class, 'deleteCategory']);

Route::post('/upload-wallpaper', [applicationController::class, 'uploadWallpaper']);
Route::get('/wallpaper-by-category/{id}', [applicationController::class, 'wallpaperByCategory']);
Route::post('/search-wallpaper', [applicationController::class, 'searchWallpaper']);
Route::post('/delete-wallpaper/{id}', [applicationController::class, 'deleteWallpaper']);
Route::post('/like-wallpaper/{id}', [applicationController::class, 'likeWallpaper']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
