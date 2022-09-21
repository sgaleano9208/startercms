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
        Schema::create('proposals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('number')->unique();
            $table->unsignedBigInteger('client_id');
            $table->date('date');
            $table->date('end_date')->nullable();
            $table->unsignedBigInteger('type_of_payment_id')->nullable();
            $table
                ->enum('status', [
                    'sent',
                    'accepted',
                    'rejected',
                    'negotiation',
                ])
                ->default('sent');
            $table->text('observation')->nullable();

            $table->index('number');

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
        Schema::dropIfExists('proposals');
    }
};
