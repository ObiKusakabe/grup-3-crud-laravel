<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'email', 'address', 'phone', 'admin_user_id'])]
class Company extends Model
{
    /**
     * Get the admin user for this company
     */
    public function adminUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_user_id');
    }

    /**
     * Get all employees for this company
     */
    public function employees(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get all products for this company
     */
    public function barangs(): HasMany
    {
        return $this->hasMany(Barang::class);
    }

    /**
     * Get all categories for this company
     */
    public function kategoriBarangs(): HasMany
    {
        return $this->hasMany(KategoriBarang::class);
    }

    /**
     * Get all suppliers for this company
     */
    public function suppliers(): HasMany
    {
        return $this->hasMany(Supplier::class);
    }

    /**
     * Get all members for this company
     */
    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }

    /**
     * Get all transactions for this company
     */
    public function transaksis(): HasMany
    {
        return $this->hasMany(Transaksi::class);
    }

    /**
     * Get all branches for this company
     */
    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class);
    }
}

