<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('periksas', function (Blueprint $table) {
            $table->foreign('id_daftar_poli')->references('id')->on('daftar_polis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('periksas', function (Blueprint $table) {
            $table->dropForeign(['id_daftar_poli']);
        });
    }
};
