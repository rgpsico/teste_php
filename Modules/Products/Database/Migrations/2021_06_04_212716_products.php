<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('Clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('email');
            $table->string('dataNascimento');
            $table->string('endereco');
            $table->string('complemento');
            $table->string('bairro');
            $table->string('cep');
            $table->timestamps();
        });

        Schema::create('Pastel', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('preco');
            $table->string('foto');
        });


        Schema::create('Pedido', function (Blueprint $table) {
            $table->increments('id');
            $table->string('CodigoCliente');
            $table->string('CodigoPastel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
