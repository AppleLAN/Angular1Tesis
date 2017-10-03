<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provider_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->enum('status', ['C','R'])->default('C');
            $table->enum('letter', ['A','B','C','M','E','X'])->nullable();
            $table->string('provider_name');
            $table->bigInteger('provider_cuit')->unsigned()->nullable();
            $table->string('provider_address')->nullable();
            $table->float('subtotal')->default(0);
            $table->float('discount')->default(0);
            $table->string('taxes')->default(0);
            $table->float('total')->default(0);
            $table->integer('company_id')->nullable()->unsigned();

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
        //
    }
}
