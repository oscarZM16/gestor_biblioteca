<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('prestamos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // funcionario que hace el préstamo
        $table->foreignId('insumo_id')->constrained()->onDelete('cascade'); // insumo prestado
        $table->integer('cantidad_prstada')->default(0);
        $table->enum('estado', ['libre','prestado', 'devuelto'])->default('libre');
        $table->date('fecha_inicio')->nullable();
        $table->string('identificacion_solicitante')->nullable();
        $table->string('email_solicitante')->nullable();
        $table->timestamps();
    });
}
}
