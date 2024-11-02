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
        Schema::create('reasons', function (Blueprint $table) {
            $table->id();
            $table->string('reason');
            $table->text('proof');
            $table->enum('type', ['Remunerado', 'No Remunerado']);
            $table->integer('max_days')->nullable(); // Campo para el máximo de días
            $table->integer('max_working_days')->nullable(); // Campo para el máximo de días hábiles
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reasons');
    }
};
