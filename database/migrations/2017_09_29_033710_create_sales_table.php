<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
 /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->enum('type', ['FC','NC','ND'])->default('FC');
            $table->enum('letter', ['A','B','C'])->nullable();
            $table->string('client_name');
            $table->bigInteger('client_cuit')->unsigned()->nullable();
            $table->string('client_address')->nullable();
            $table->string('pos')->default(0);
            $table->string('number')->default(0);
            $table->float('discount')->default(0);
            $table->float('subtotal')->default(0);
            $table->float('total')->default(0);
            $table->float('perceptions')->default(0);
            $table->string('taxes')->default('{}');
            $table->text('response')->nullable();
            $table->integer('warehouse_id')->nullable()->unsigned();
            $table->date('date');

            $table->softDeletes();
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
        Schema::drop('sales');
    }
}
