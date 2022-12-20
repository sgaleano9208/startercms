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
        Schema::table('action_plans', function (Blueprint $table) {
            $table
                ->foreign('appointment_id')
                ->references('id')
                ->on('appointments')
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
        Schema::table('action_plans', function (Blueprint $table) {
            $table->dropForeign(['appointment_id']);
        });
    }
};
