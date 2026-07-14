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
        Schema::table('barangs', function (Blueprint $table) {
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade')->after('id');
        });

        Schema::table('kategori_barang', function (Blueprint $table) {
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade')->after('id');
        });

        Schema::table('supplier', function (Blueprint $table) {
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade')->after('id');
        });

        Schema::table('member', function (Blueprint $table) {
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade')->after('id');
        });

        Schema::table('transaksis', function (Blueprint $table) {
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade')->after('id');
        });

        Schema::table('detail_transaksi', function (Blueprint $table) {
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade')->after('id');
        });

        Schema::table('product_stocks', function (Blueprint $table) {
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade')->after('id');
        });

        Schema::table('stock_movements', function (Blueprint $table) {
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade')->after('id');
        });

        Schema::table('branches', function (Blueprint $table) {
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->dropConstrainedForeignId('company_id');
        });

        Schema::table('kategori_barang', function (Blueprint $table) {
            $table->dropConstrainedForeignId('company_id');
        });

        Schema::table('supplier', function (Blueprint $table) {
            $table->dropConstrainedForeignId('company_id');
        });

        Schema::table('member', function (Blueprint $table) {
            $table->dropConstrainedForeignId('company_id');
        });

        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropConstrainedForeignId('company_id');
        });

        Schema::table('detail_transaksi', function (Blueprint $table) {
            $table->dropConstrainedForeignId('company_id');
        });

        Schema::table('product_stocks', function (Blueprint $table) {
            $table->dropConstrainedForeignId('company_id');
        });

        Schema::table('stock_movements', function (Blueprint $table) {
            $table->dropConstrainedForeignId('company_id');
        });

        Schema::table('branches', function (Blueprint $table) {
            $table->dropConstrainedForeignId('company_id');
        });
    }
};

