<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AdsController;
use App\Http\Controllers\api\AdvertisersController;
use App\Http\Controllers\api\CategoriesController;
use App\Http\Controllers\api\TagsController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('ads',AdsController::class);
Route::get('ads/advertiser/{email}',[AdsController::class, 'adsByAdvertisers']);
Route::get('ads/tags/{tag}',[AdsController::class, 'adsFilterByTag']);
Route::get('ads/categories/{category}',[AdsController::class, 'adsFilterByCategory']);


Route::apiResource('advertisers',AdvertisersController::class);

Route::apiResource('categories',CategoriesController::class);

Route::apiResource('tags',TagsController::class);
