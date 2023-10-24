<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('/admin')->group(function () {
    //category
    Route::get('/categories',[CategoryController::class,'index'])->name('categories');
    Route::post('/categories',[CategoryController::class,'store']);
    Route::put('/categories/{id}',[CategoryController::class,'edit']);
    Route::post('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'delete']);
    Route::get('/categories/{search}', [CategoryController::class, 'search']);
});