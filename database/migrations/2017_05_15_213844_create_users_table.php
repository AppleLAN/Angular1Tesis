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
        Schema::dropIfExists('users');
    }
}