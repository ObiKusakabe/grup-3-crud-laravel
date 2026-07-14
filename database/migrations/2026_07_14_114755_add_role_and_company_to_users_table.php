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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'pos', 'inventaris'])->default('admin')->after('email');
            $table->bigInteger('company_id')->nullable()->after('role');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null')->after('company_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'company_id', 'created_by']);
        });
    }
};
