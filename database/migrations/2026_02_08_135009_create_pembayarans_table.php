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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->foreignId('id_tagihan')->constrained('tagihans', 'id_tagihan');
            $table->foreignId('id_pelanggan')->constrained('pelanggans', 'id_pelanggan');
            $table->foreignId('id_user')->constrained('users', 'id_user');
            $table->date('tanggal_pembayaran');
            $table->integer('bulan_bayar');
            $table->decimal('biaya_admin', 10, 2);
            $table->decimal('total_bayar', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
