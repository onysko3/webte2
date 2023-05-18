<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('set_id');
            $table->string('task_name')->unique();    //cislo v section v subore (hodi sa pre zobrazenie ulohy v prehladoch)
            $table->string('assignment');
            $table->string('img_name')->nullable();
            $table->string('results');

            $table->foreign('set_id')->references('id')->on('sets')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
