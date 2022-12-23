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
        Schema::create('action_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id');
            $table->string('title');
            $table->date('date')->nullable();
            $table->text('note')->nullable();
            $table->json('offer')->nullable();
            $table->unsignedBigInteger('action_planable_id');
            $table->string('action_planable_type');
            $table->enum('status', ['started', 'finished'])->default('started');

            $table->index('action_planable_id');
            $table->index('action_planable_type');

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
        Schema::dropIfExists('action_plans');
    }
};
