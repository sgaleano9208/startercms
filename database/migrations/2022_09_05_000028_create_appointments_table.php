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
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('zone_appointment_id');
            $table->unsignedBigInteger('client_id');
            $table->date('date');
            $table->dateTime('time');
            $table->json('goals')->nullable();
            $table->string('attachments')->nullable();
            $table->text('details')->nullable();
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
        Schema::dropIfExists('appointments');
    }
};
