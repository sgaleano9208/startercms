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
        Schema::table('client_monthly_sales', function (Blueprint $table) {
            $table
                ->foreign('client_no_nav')
                ->references('id')
                ->on('clients')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('cooperative_cod')
                ->references('id')
                ->on('cooperatives')
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
        Schema::table('client_monthly_sales', function (Blueprint $table) {
            $table->dropForeign(['client_no_nav']);
            $table->dropForeign(['cooperative_cod']);
        });
    }
};
