<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clasificaciones_tematicas', function (Blueprint $table) {
            $table->id(); // id AUTO_INCREMENT
            $table->string('nombre');
            $table->text('descripcion');
            $table->timestamps();
        });

        DB::table('clasificaciones_tematicas')->insert([
            ['id' => 1, 'nombre' => 'Literatura y ficción', 'descripcion' => 'Obras narrativas imaginarias creadas por autores.'],
            ['id' => 2, 'nombre' => 'Ciencia ficción y fantasía', 'descripcion' => 'Historias con elementos tecnológicos o mágicos en mundos imaginarios.'],
            ['id' => 3, 'nombre' => 'Misterio y suspenso', 'descripcion' => 'Narrativas centradas en resolver enigmas o crímenes.'],
            ['id' => 4, 'nombre' => 'Terror', 'descripcion' => 'Historias diseñadas para provocar miedo o inquietud.'],
            ['id' => 5, 'nombre' => 'Romance', 'descripcion' => 'Relatos que se centran en relaciones amorosas.'],
            ['id' => 6, 'nombre' => 'Historia', 'descripcion' => 'Obras sobre hechos y personajes del pasado.'],
            ['id' => 7, 'nombre' => 'Biografía y autobiografía', 'descripcion' => 'Relatos sobre la vida de personas reales.'],
            ['id' => 8, 'nombre' => 'Ciencias sociales', 'descripcion' => 'Estudios sobre el comportamiento humano y la sociedad.'],
            ['id' => 9, 'nombre' => 'Psicología', 'descripcion' => 'Textos sobre procesos mentales y comportamiento.'],
            ['id' => 10, 'nombre' => 'Filosofía', 'descripcion' => 'Obras que tratan sobre el pensamiento, el ser y el conocimiento.'],
            ['id' => 11, 'nombre' => 'Ciencias naturales', 'descripcion' => 'Libros sobre biología, física, química, etc.'],
            ['id' => 12, 'nombre' => 'Matemáticas', 'descripcion' => 'Obras sobre teoría, cálculo y lógica matemática.'],
            ['id' => 13, 'nombre' => 'Tecnología e ingeniería', 'descripcion' => 'Aplicaciones prácticas de ciencia para resolver problemas.'],
            ['id' => 14, 'nombre' => 'Medicina y salud', 'descripcion' => 'Libros sobre el cuerpo humano, enfermedades y tratamientos.'],
            ['id' => 15, 'nombre' => 'Economía y negocios', 'descripcion' => 'Estudios sobre producción, mercado, finanzas y empresas.'],
            ['id' => 16, 'nombre' => 'Derecho', 'descripcion' => 'Normas y leyes que rigen la sociedad.'],
            ['id' => 17, 'nombre' => 'Religión y espiritualidad', 'descripcion' => 'Creencias, prácticas y doctrinas religiosas.'],
            ['id' => 18, 'nombre' => 'Arte y música', 'descripcion' => 'Análisis, historia y apreciación de las artes visuales y sonoras.'],
            ['id' => 19, 'nombre' => 'Educación y pedagogía', 'descripcion' => 'Textos sobre enseñanza y aprendizaje.'],
            ['id' => 20, 'nombre' => 'Viajes', 'descripcion' => 'Narraciones, guías o experiencias sobre lugares del mundo.'],
            ['id' => 21, 'nombre' => 'Gastronomía', 'descripcion' => 'Estudios y recetas sobre comida y cocina.'],
            ['id' => 22, 'nombre' => 'Autoayuda y desarrollo personal', 'descripcion' => 'Libros orientados al crecimiento emocional y profesional.'],
            ['id' => 23, 'nombre' => 'Política y sociedad', 'descripcion' => 'Estudios sobre gobiernos, estructuras sociales y ciudadanía.'],
            ['id' => 24, 'nombre' => 'Ensayo', 'descripcion' => 'Textos reflexivos sobre temas diversos, generalmente no ficticios.'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('clasificaciones_tematicas');
    }
};
