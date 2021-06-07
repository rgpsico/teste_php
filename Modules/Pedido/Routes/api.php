<?php

use Illuminate\Http\Request;

use Modules\Pedido\Http\Controllers\PedidoController;

Route::group(array('prefix' => 'pedidos'), function() {

Route::get('/', [PedidoController::class, 'index']);
Route::post('posts', [PedidoController::class, 'store']);
Route::get('/{id}', [PedidoController::class, 'show']);
Route::post('/edit', [PedidoController::class, 'edit']);
Route::delete('/{id}/delete', [PedidoController::class, 'destroy']);

});