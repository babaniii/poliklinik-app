<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('detail_periksa', function (Blueprint $table) {
        $table->foreignId('id_pasien')
              ->after('id')
              ->constrained('users')
              ->cascadeOnDelete();

        $table->integer('jumlah')
              ->after('id_obat');
    });
}

public function down(): void
{
    Schema::table('detail_periksa', function (Blueprint $table) {
        $table->dropForeign(['id_pasien']);
        $table->dropColumn(['id_pasien', 'jumlah']);
    });
}
};
