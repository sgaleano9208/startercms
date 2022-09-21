<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_cooperative', function (Blueprint $table) {
            $table
                ->foreign('cooperative_id')
                ->references('id')
                ->on('cooperatives')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_cooperative', function (Blueprint $table) {
            $table->dropForeign(['cooperative_id']);
            $table->dropForeign(['client_id']);
        });
    }
};
