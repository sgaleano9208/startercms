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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('ref', 7)->unique();
            $table->string('photo')->nullable();
            $table->text('description')->nullable();
            $table->string('certificate')->nullable();
            $table->string('technical_sheet')->nullable();
            $table->unsignedBigInteger('family_id')->nullable();
            $table->unsignedBigInteger('sub_family_id')->nullable();
            $table->enum('type', ['own', 'distributed'])->default('own');
            $table->unsignedBigInteger('brand_id')->nullable();

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
        Schema::dropIfExists('products');
    }
};
