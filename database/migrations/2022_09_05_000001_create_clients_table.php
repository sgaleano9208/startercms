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
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table
                ->string('phone')
                ->nullable()
                ->unique();
            $table
                ->string('email')
                ->nullable()
                ->unique();
            $table
                ->string('vat', 11)
                ->nullable()
                ->unique();
            $table
                ->string('no_nav', 11)
                ->nullable()
                ->unique();
            $table->decimal('discount')->nullable();
            $table->text('observation')->nullable();
            $table
                ->enum('type', ['member', 'directional', 'lead'])
                ->default('member');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('typology_id')->nullable();
            $table->unsignedBigInteger('sales_person_id')->nullable();

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
        Schema::dropIfExists('clients');
    }
};
