<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Doctrine\DBAL\Types\Type;

class AddFKUserIDDestinatarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('destinatario', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('typesRefered_id')->references('id')->on('typesRefered');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('destinatario', function (Blueprint $table) {
            $table->dropForeign('destinatario_typesRefered_id_foreign');
            $table->dropForeign('destinatario_user_id_foreign');
        });
    }
}
