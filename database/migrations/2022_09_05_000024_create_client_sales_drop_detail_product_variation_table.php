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
        Schema::create('client_sales_drop_detail_product_variation', function (
            Blueprint $table
        ) {
            $table->unsignedBigInteger('product_variation_id');
            $table->unsignedBigInteger('client_sales_drop_detail_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_sales_drop_detail_product_variation');
    }
};
