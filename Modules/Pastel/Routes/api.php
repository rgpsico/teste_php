<?php

use Illuminate\Http\Request;


use Modules\Pastel\Http\Controllers\PastelController;

Route::group(array('prefix' => 'pastel'), function() {

Route::get('/', [PastelController::class, 'index']);
Route::post('posts', [PastelController::class, 'store']);
Route::get('/{id}', [PastelController::class, 'show']);
Route::post('/edit', [PastelController::class, 'edit']);
Route::delete('/{id}/delete', [PastelController::class, 'destroy']);

});


