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
    Schema::table('reservasis', function (Blueprint $table) {
        $table->string('metode_pembayaran')->nullable();
        $table->string('status_pembayaran')->default('belum_bayar');
    });
}

public function down()
{
    Schema::table('reservasis', function (Blueprint $table) {
        $table->dropColumn(['metode_pembayaran', 'status_pembayaran']);
    });
}

};
