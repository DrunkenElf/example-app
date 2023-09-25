<?php

use App\Http\Controllers\CategoryController;
use App\Http\Middleware\AuthenticateOnceWithBasicAuth;
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
Route::post('create', [CategoryController::class, 'store'])->name('store');

Route::group([
    'prefix' => 'category/',
    'as' => 'category.',
], function () {
    Route::post('create', [CategoryController::class, 'store'])->name('store');
    Route::post('update', [CategoryController::class, 'update'])->name('update');
    Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('delete');
    Route::get('find/{id}', [CategoryController::class, 'findById'])->name('find-by-id');

    Route::get('search', [CategoryController::class, 'search'])->name('search');
});

