<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kamars', function (Blueprint $table) {
            if (!Schema::hasColumn('kamars', 'tempat_tidur')) {
                $table->string('tempat_tidur')->nullable()->after('fasilitas');
            }
        });
    }

    public function down(): void
    {
        Schema::table('kamars', function (Blueprint $table) {
            if (Schema::hasColumn('kamars', 'tempat_tidur')) {
                $table->dropColumn('tempat_tidur');
            }
        });
    }
};
