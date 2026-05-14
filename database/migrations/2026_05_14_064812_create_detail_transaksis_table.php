<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi');
            $table->string('nama_barang');
            $table->string('ukuran');
            $table->string('warna');
            $table->integer('jumlah');
            $table->decimal('harga_satuan', 15, 2);
            $table->decimal('subtotal', 15, 2);
            $table->enum('jenis', ['jual', 'retur'])->default('jual');
            $table->text('alasan_retur')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('detail_transaksi');
    }
};