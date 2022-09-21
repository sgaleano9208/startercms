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
        Schema::create('sales_people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table
                ->string('email')
                ->nullable()
                ->unique();
            $table
                ->string('phone')
                ->nullable()
                ->unique();
            $table->string('cod');
            $table->unsignedBigInteger('commercial_id')->nullable();
            $table->unsignedBigInteger('sales_manager_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_people');
    }
};
