<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 public function up()
{
    Schema::create('reservasis', function (Blueprint $table) {
        $table->id();
        $table->foreignId('tamu_id')->constrained()->onDelete('cascade');
        $table->foreignId('kamar_id')->constrained()->onDelete('cascade');
        $table->date('check_in');
        $table->date('check_out');
        $table->decimal('total_bayar', 12, 2)->default(0);
        $table->enum('metode_pembayaran', ['transfer', 'debit', 'cash', 'qris'])->nullable();
        $table->enum('status_pembayaran', ['lunas', 'belum lunas'])->default('belum lunas');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
