<?php

use Illuminate\Http\Request;


use Modules\Cliente\Http\Controllers\ClienteController;

Route::group(array('prefix' => 'clientes'), function() {

Route::get('/', [ClienteController::class, 'index']);
Route::post('posts', [ClienteController::class, 'store']);
Route::get('/{id}', [ClienteController::class, 'show']);
Route::post('/edit', [ClienteController::class, 'edit']);
Route::delete('/{id}/delete', [ClienteController::class, 'destroy']);

});