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
        Schema::create('penggunaans', function (Blueprint $table) {
            $table->id('id_penggunaan');
            $table->foreignId('id_pelanggan')->constrained('pelanggans', 'id_pelanggan');
            $table->integer('bulan');
            $table->integer('tahun');
            $table->integer('meter_awal');
            $table->integer('meter_ahir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunaans');
    }
};
