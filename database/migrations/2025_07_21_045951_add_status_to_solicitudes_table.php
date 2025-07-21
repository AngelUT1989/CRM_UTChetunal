<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToSolicitudesTable extends Migration
{
    public function up()
    {
        Schema::table('solicitudes', function (Blueprint $table) {
            // Añadimos un enum con los tres estados
            $table->enum('status', ['pendiente','en_seguimiento'])
                  ->default('pendiente')
                  ->after('aceptacion_terminos');
        });
    }

    public function down()
    {
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
