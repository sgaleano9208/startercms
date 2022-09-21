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
        Schema::table('client_sales_drop_details', function (Blueprint $table) {
            $table
                ->foreign('client_sales_drop_id')
                ->references('id')
                ->on('client_sales_drops')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('drop_reason_id')
                ->references('id')
                ->on('drop_reasons')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('competitor_id')
                ->references('id')
                ->on('competitors')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('family_id')
                ->references('id')
                ->on('families')
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
        Schema::table('client_sales_drop_details', function (Blueprint $table) {
            $table->dropForeign(['client_sales_drop_id']);
            $table->dropForeign(['drop_reason_id']);
            $table->dropForeign(['competitor_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['family_id']);
        });
    }
};
