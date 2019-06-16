<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
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
            $table->string('iib');
            $table->string('pib');
            $table->string('epib');
            $table->boolean('excento');
            $table->boolean('responsableMonotributo');
            $table->boolean('responsableInscripto');
            $table->boolean('ivaInscripto');
            $table->float('limiteDeCredito');
            $table->integer('numeroDeInscripcionesIB');
            $table->string('cuentasGenerales');
            $table->integer('percepcionDeGanancia');
            $table->date('created_at')->nullable();
            $table->date('updated_at')->nullable();
            $table->date('deleted_at')->nullable();
            $table->unique('name', 'fantasyName');
        });
        
        Schema::table('users', function (Blueprint $table) {
             $table->integer('company_id')->unsigned()->nullable()->after('id');
            $table->foreign('company_id')->references('id')->on('companies');
        });

        Schema::table('clients', function (Blueprint $table) {
            $table->integer('company_id')->unsigned()->nullable()->after('id');            
            $table->foreign('company_id')->references('id')->on('companies');
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
