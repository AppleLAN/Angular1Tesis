<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId');
            $table->boolean('isData');
            $table->string('name');
            $table->string('fantasyName');
            $table->string('email');
            $table->string('place');
            $table->string('codigoPostal');
            $table->string('codigoProvincia');
            $table->string('address');
            $table->integer('telephone');
            $table->string('cuit');
            $table->string('web');
            $table->boolean('new');
            $table->string('iib');
            $table->string('pib');
            $table->string('epib');
            $table->boolean('excento');
            $table->boolean('responsableMonotributo');
            $table->boolean('responsableInscripto');
            $table->boolean('ivaInscripto');
            $table->float('precioLista');
            $table->string('condicionDeVenta');
            $table->float('limiteDeCredito');
            $table->integer('numeroDeInscripcionesIB');
            $table->string('cuentasGenerales');
            $table->integer('percepcionDeGanancia');
            $table->date('createdAt')->nullable();
            $table->date('updatedAt')->nullable();
            $table->date('deletedAt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
