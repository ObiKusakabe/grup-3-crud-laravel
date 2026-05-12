<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique();
            $table->date('tanggal');
            $table->string('kasir');
            $table->string('nama_member')->nullable();
            $table->decimal('total_bayar', 15, 2);
            $table->decimal('diskon', 15, 2)->default(0);
            $table->decimal('total_akhir', 15, 2);
            $table->decimal('tunai', 15, 2);
            $table->decimal('kembalian', 15, 2);
            $table->enum('status', ['Pending', 'Selesai', 'Batal'])->default('Pending');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};