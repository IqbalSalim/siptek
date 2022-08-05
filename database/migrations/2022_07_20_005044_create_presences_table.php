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
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->char('type', 4);
            $table->string('come_photo')->nullable();
            $table->string('go_photo')->nullable();
            $table->string('file')->nullable();
            $table->time('come_presence')->nullable();
            $table->time('go_presence')->nullable();
            $table->string('description')->nullable();
            $table->enum('status', ['approved', 'submission', 'rejected'])->nullable();
            $table->integer('late_minutes')->nullable();
            $table->integer('quick_minutes')->nullable();
            $table->string('code')->nullable();
            $table->string('feedback')->nullable();
            $table->float('percent')->nullable();
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
        Schema::dropIfExists('presences');
    }
};
