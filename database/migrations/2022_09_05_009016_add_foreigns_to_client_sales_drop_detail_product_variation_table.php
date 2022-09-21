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
        Schema::table('client_sales_drop_detail_product_variation', function (
            Blueprint $table
        ) {
            $table
                ->foreign('product_variation_id', 'foreign_alias_0000001')
                ->references('id')
                ->on('product_variations')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign(
                    'client_sales_drop_detail_id',
                    'foreign_alias_0000002'
                )
                ->references('id')
                ->on('client_sales_drop_details')
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
        Schema::table('client_sales_drop_detail_product_variation', function (
            Blueprint $table
        ) {
            $table->dropForeign(['product_variation_id']);
            $table->dropForeign(['client_sales_drop_detail_id']);
        });
    }
};
