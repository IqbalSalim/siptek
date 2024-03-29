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
        Schema::create('employees', function (Blueprint $table) {
            $table->bigInteger('user_id')->primary();
            $table->char('member_id', 5);
            $table->foreignId('area_id')->constrained('areas')->onUpdate('cascade')->onDelete('cascade');
            $table->string('birthplace');
            $table->date('birthdate');
            $table->string('last_education');
            $table->char('phone', 13);
            $table->string('address');
            $table->string('image');
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
        Schema::dropIfExists('employees');
    }
};
