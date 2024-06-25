<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')
                ->references('id')->on('departments');
            $table->string('name');
            $table->boolean('gender');
            $table->boolean('boss')->nullable();
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('dni')->unique();
            $table->string('functional')->nullable();
            $table->string('nominal')->nullable();
            $table->enum('type', ['Permanente', 'Contrato','Interinato']);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
