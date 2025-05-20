<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipos_obras', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->timestamps();
        });

        DB::table('tipos_obras')->insert([
            ['id' => 1, 'nombre' => 'Ficción', 'descripcion' => 'Obras con contenido imaginario.'],
            ['id' => 2, 'nombre' => 'No ficción', 'descripcion' => 'Libros basados en hechos reales.'],
            ['id' => 3, 'nombre' => 'Documental', 'descripcion' => 'Textos que documentan la realidad con evidencia.'],
            ['id' => 4, 'nombre' => 'Científico / técnico', 'descripcion' => 'Obras de divulgación o investigación científica.'],
            ['id' => 5, 'nombre' => 'Didáctico / educativo', 'descripcion' => 'Material destinado a la enseñanza.'],
            ['id' => 6, 'nombre' => 'Referencia', 'descripcion' => 'Obras de consulta como diccionarios, atlas o enciclopedias.'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('tipos_obras');
    }
};
