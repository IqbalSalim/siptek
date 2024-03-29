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
        Schema::create('times', function (Blueprint $table) {
            $table->id();
            $table->string('day');
            $table->time('come_start_time');
            $table->time('come_end_time');
            $table->time('come_time');
            $table->time('go_start_time');
            $table->time('go_end_time');
            $table->time('go_time');
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
        Schema::dropIfExists('times');
    }
};
