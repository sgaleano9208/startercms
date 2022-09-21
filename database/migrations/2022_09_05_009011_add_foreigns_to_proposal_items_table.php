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
        Schema::table('proposal_items', function (Blueprint $table) {
            $table
                ->foreign('proposal_id')
                ->references('id')
                ->on('proposals')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('product_variation_id')
                ->references('id')
                ->on('product_variations')
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
        Schema::table('proposal_items', function (Blueprint $table) {
            $table->dropForeign(['proposal_id']);
            $table->dropForeign(['product_variation_id']);
        });
    }
};
