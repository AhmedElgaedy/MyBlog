<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('/admin')->group(function () {
    
    //category
    Route::get   ('/categories',          [CategoryController::class,'index'  ]);
    Route::post  ('/categories',          [CategoryController::class,'store'  ]);
    Route::put   ('/categories/{id}',     [CategoryController::class,'edit'   ]);
    Route::post  ('/categories/{id}',     [CategoryController::class, 'update']);
    Route::delete('/categories/{id}',     [CategoryController::class, 'delete']);
    Route::get   ('/categories/{search}', [CategoryController::class, 'search']);


    //posts
    Route::get   ('/posts',          [PostController::class, 'index' ]);
    Route::post  ('/posts',          [PostController::class, 'store' ]);
    Route::put   ('/posts/{id}',     [PostController::class, 'edit'  ]);
    Route::post  ('/posts/{id}',    [PostController::class, 'update']);
    Route::delete('/posts/{id}',     [PostController::class, 'delete']);
    Route::get   ('/posts/{search}', [PostController::class, 'search']);
});