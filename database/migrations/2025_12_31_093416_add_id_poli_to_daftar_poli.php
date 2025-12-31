<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('daftar_poli', function (Blueprint $table) {
        $table->foreignId('id_poli')
              ->after('id_pasien')
              ->constrained('poli')
              ->cascadeOnDelete();
    });
}

public function down()
{
    Schema::table('daftar_poli', function (Blueprint $table) {
        $table->dropForeign(['id_poli']);
        $table->dropColumn('id_poli');
    });
}
};
