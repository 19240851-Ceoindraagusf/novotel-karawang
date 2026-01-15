<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservasis', function (Blueprint $table) {
            if (!Schema::hasColumn('reservasis', 'metode_pembayaran')) {
                $table->enum('metode_pembayaran', ['transfer', 'debit', 'cash', 'qris'])->nullable()->after('total_bayar');
            }
            if (!Schema::hasColumn('reservasis', 'status_pembayaran')) {
                $table->enum('status_pembayaran', ['lunas', 'belum lunas'])->default('belum lunas')->after('metode_pembayaran');
            }
        });
    }

    public function down(): void
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->dropColumn(['metode_pembayaran', 'status_pembayaran']);
        });
    }
};
