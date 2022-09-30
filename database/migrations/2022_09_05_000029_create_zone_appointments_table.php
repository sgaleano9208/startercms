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
        Schema::create('zone_appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sales_person_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['pending', 'done']);

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
        Schema::dropIfExists('zone_appointments');
    }
};
