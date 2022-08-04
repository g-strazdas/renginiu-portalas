<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('place');
            $table->string('organizer');
            $table->string('phone');
            $table->string('starts');
            $table->string('ends');
            $table->longText('description');
            $table->string('logo')->nullable();
            $table->integer('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_models');
    }
};
