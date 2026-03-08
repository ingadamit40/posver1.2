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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_empresa');
            $table->string('tipo_empresa');
            $table->string('rfc', 20)->unique();
            $table->string('telefono', 20);
            $table->string('email')->unique();
            $table->string('direccion');
            $table->string('ciudad');
            $table->string('estado');
            $table->string('codigo_postal');
            $table->text('logo');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
