<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\FrontEnd\GetPostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('/admin')->group(function () {
    
    //categories
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
    Route::post  ('/posts/{id}',     [PostController::class, 'update']);
    Route::delete('/posts/{id}',     [PostController::class, 'delete']);
    Route::get   ('/posts/{search}', [PostController::class, 'search']);



    //settings
    Route::get   ('/settings',         [SettingController::class, 'index'  ]);
    Route::get   ('/settings/{id}',    [SettingController::class, 'update' ]);

   



});


Route::prefix('/frontend')->group(function () {

    Route::get ('/all-posts', [GetPostController::class,'index'] );
    Route::get ('/views-posts', [GetPostController::class,'viewposts'] );
    Route::get('/post-by-id/{id}', [GetPostController::class,'getPostById'] );
    Route::get('/post-by-cat/{id}', [GetPostController::class,'getPostByCategory'] );
    Route::get('/search-posts/{search}', [GetPostController::class, 'searchPost']);
});