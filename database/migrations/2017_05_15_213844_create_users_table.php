<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('name');
            $table->string('lastname');
            $table->string('email');
            $table->string('password');            
            $table->date('birthday');
            $table->string('address');
            $table->boolean('sales');
            $table->boolean('providers');
            $table->boolean('stock');
            $table->boolean('clients');
            $table->date('created_at')->nullable();
            $table->date('updated_at')->nullable();
            $table->date('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}