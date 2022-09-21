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
        Schema::create('promotion_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('promotion_id');
            $table->unsignedBigInteger('product_variation_id');
            $table->string('name');
            $table->decimal('promo_price')->nullable();
            $table->decimal('discount')->nullable();
            $table->decimal('price')->nullable();
            $table->integer('current_sales')->nullable();
            $table->integer('past_sales')->nullable();
            $table->boolean('is_selected')->default(false);

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
        Schema::dropIfExists('promotion_items');
    }
};
