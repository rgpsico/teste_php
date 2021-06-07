<?php

use Illuminate\Http\Request;

use Modules\Products\Http\Controllers\ProductsController;


Route::get('/', [ProductsController::class, 'index']);
Route::post('posts', [ProductsController::class, 'store']);
Route::get('product/{id}', [ProductsController::class, 'show']);
Route::post('product/edit', [ProductsController::class, 'edit']);
Route::delete('product/{id}/delete', [ProductsController::class, 'destroy']);