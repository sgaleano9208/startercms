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
        Schema::table('zone_appointments', function (Blueprint $table) {
            $table
                ->foreign('sales_person_id')
                ->references('id')
                ->on('sales_people')
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
        Schema::table('zone_appointments', function (Blueprint $table) {
            $table->dropForeign(['sales_person_id']);
        });
    }
};
