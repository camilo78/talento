<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialtiesTable extends Migration
{
    public function up()
    {
        Schema::create('specialties', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre de la especialidad
            $table->unsignedBigInteger('profession_id'); // Relación con la profesión
            $table->timestamps();
            $table->foreign('profession_id')->references('id')->on('professions')->onDelete('cascade'); // Relación con la tabla professions
        });
    }

    public function down()
    {
        Schema::dropIfExists('specialties');
    }
}
