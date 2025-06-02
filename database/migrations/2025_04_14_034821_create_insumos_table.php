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
            $table->enum('estado',['disponible','agotado'])->default('disponible'); // disponible, agotado.

            // Relaciones con otras tablas
            $table->unsignedBigInteger('clasificaciones_tematicas_id')->nullable();
            $table->unsignedBigInteger('generos_literarios_id')->nullable();
            $table->unsignedBigInteger('publicos_objetivos_id')->nullable();
            $table->unsignedBigInteger('tipos_obras_id')->nullable();

            $table->timestamps();

            // Definición de claves foráneas
            $table->foreign('clasificaciones_tematicas_id')->references('id')->on('clasificaciones_tematicas')->onDelete('set null');
            $table->foreign('generos_literarios_id')->references('id')->on('generos_literarios')->onDelete('set null');
            $table->foreign('publicos_objetivos_id')->references('id')->on('publicos_objetivos')->onDelete('set null');
            $table->foreign('tipos_obras_id')->references('id')->on('tipos_obras')->onDelete('set null');
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
