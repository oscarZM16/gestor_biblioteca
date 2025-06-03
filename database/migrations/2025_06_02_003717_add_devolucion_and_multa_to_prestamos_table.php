<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDevolucionAndMultaToPrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prestamos', function (Blueprint $table) {
            $table->date('fecha_entrega')->nullable()->after('fecha_inicio');
            $table->date('fecha_devolucion')->nullable()->after('fecha_entrega');
            $table->decimal('multa', 8, 2)->default(0)->after('fecha_devolucion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prestamos', function (Blueprint $table) {
            $table->dropColumn(['fecha_estimada_devolucion','fecha_devolucion','multa']);
        });
    }
}
