<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->integer('nmcliente');
            $table->string('dsnombres');
            $table->string('dsapellidos');
            $table->string('dsdireccion');
            $table->string('dscorreo');
            $table->string('cdtelefono');
            $table->string('cdtelefonoalter');
            $table->string('cdcelular');
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
        Schema::dropIfExists('clientes');
    }
}
