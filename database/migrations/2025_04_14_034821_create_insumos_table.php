<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsumosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insumos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->integer('cantidad')->default(1);
            $table->string('estado')->default('disponible'); // disponible, prestado.

            // Relaciones con otras tablas
            $table->unsignedBigInteger('clasificacion_tematica_id')->nullable();
            $table->unsignedBigInteger('genero_literario_id')->nullable();
            $table->unsignedBigInteger('publico_objetivo_id')->nullable();
            $table->unsignedBigInteger('tipo_de_obra_id')->nullable();

            $table->timestamps();

            // Definición de claves foráneas
            $table->foreign('clasificacion_tematica_id')->references('id')->on('clasificacion_tematica')->onDelete('set null');
            $table->foreign('genero_literario_id')->references('id')->on('genero_literario')->onDelete('set null');
            $table->foreign('publico_objetivo_id')->references('id')->on('publico_objetivo')->onDelete('set null');
            $table->foreign('tipo_de_obra_id')->references('id')->on('tipo_obra')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insumos');
    }
}
