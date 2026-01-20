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
        Schema::table('kamars', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->after('foto');
            $table->string('area')->nullable()->after('deskripsi');
            $table->integer('maks_orang')->nullable()->after('area');
            $table->text('fasilitas')->nullable()->after('maks_orang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kamars', function (Blueprint $table) {
            $table->dropColumn(['deskripsi', 'area', 'maks_orang', 'fasilitas']);
        });
    }
};
