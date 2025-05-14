<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('genero_literario', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->timestamps();
        });

        DB::table('genero_literario')->insert([
            ['id' => 1, 'nombre' => 'Narrativa', 'descripcion' => 'Prosa literaria que cuenta historias, como novelas y cuentos.'],
            ['id' => 2, 'nombre' => 'Lírico', 'descripcion' => 'Obras en verso que expresan emociones, como la poesía.'],
            ['id' => 3, 'nombre' => 'Dramático', 'descripcion' => 'Textos destinados a ser representados en teatro.'],
            ['id' => 4, 'nombre' => 'Ensayo', 'descripcion' => 'Texto argumentativo que expone ideas o reflexiones.'],
            ['id' => 5, 'nombre' => 'Crónica', 'descripcion' => 'Relato de hechos reales en orden cronológico.'],
            ['id' => 6, 'nombre' => 'Epistolar', 'descripcion' => 'Obras escritas en forma de cartas.'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('genero_literario');
    }
};
