<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('publico_objetivo', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->timestamps();
        });

        DB::table('publico_objetivo')->insert([
            ['id' => 1, 'nombre' => 'Infantil', 'descripcion' => 'Libros destinados a niños pequeños, con lenguaje simple e ilustraciones.'],
            ['id' => 2, 'nombre' => 'Juvenil', 'descripcion' => 'Obras para adolescentes, con temas acordes a su edad.'],
            ['id' => 3, 'nombre' => 'Adulto', 'descripcion' => 'Textos para lectores maduros, con temas complejos o sensibles.'],
            ['id' => 4, 'nombre' => 'Académico / Profesional', 'descripcion' => 'Libros técnicos o científicos para estudios avanzados o expertos.'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('publico_objetivo');
    }
};
