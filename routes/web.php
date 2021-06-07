<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    Mail::send('mail.treinaweb',['cursos'=>'eloquente'],function($m){
        $m->from('rgdogalo10@gmail.com','Elton');
        $m->to('contato@rogerneves.com.br');
    });
});
