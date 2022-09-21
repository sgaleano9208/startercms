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
        Schema::create('proposal_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('proposal_id');
            $table->unsignedBigInteger('product_variation_id');
            $table->string('name')->nullable();
            $table->decimal('price')->nullable();
            $table->decimal('discount')->nullable();
            $table->decimal('discount2')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('net_price')->nullable();
            $table->decimal('total')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposal_items');
    }
};
