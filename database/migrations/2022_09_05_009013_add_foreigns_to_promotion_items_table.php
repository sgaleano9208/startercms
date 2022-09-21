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
        Schema::table('promotion_items', function (Blueprint $table) {
            $table
                ->foreign('promotion_id')
                ->references('id')
                ->on('promotions')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('product_variation_id')
                ->references('id')
                ->on('product_variations')
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
        Schema::table('promotion_items', function (Blueprint $table) {
            $table->dropForeign(['promotion_id']);
            $table->dropForeign(['product_variation_id']);
        });
    }
};
