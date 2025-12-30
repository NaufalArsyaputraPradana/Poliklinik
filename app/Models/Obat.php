<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Model Obat - Data obat-obatan
 */
class Obat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_obat',
        'kemasan',
        'harga',
        'stok',
        'stok_minimum'
    ];

    protected $casts = [
        'harga' => 'integer',
        'stok' => 'integer',
        'stok_minimum' => 'integer'
    ];

    // RELATIONSHIPS
    public function detailPeriksa()
    {
        return $this->hasMany(DetailPeriksa::class, 'id_obat');
    }

    // HELPER METHODS

    /**
     * Check if stock is sufficient for requested amount
     *
     * @param int $quantity
     * @return bool
     */
    public function hasStockAvailable(int $quantity): bool
    {
        return $this->stok >= $quantity;
    }

    /**
     * Decrease stock by specified amount (for prescription)
     *
     * @param int $quantity
     * @return bool
     */
    public function decreaseStock(int $quantity): bool
    {
        if (!$this->hasStockAvailable($quantity)) {
            return false;
        }

        $this->stok -= $quantity;
        return $this->save();
    }

    /**
     * Get stock status label for display
     * Returns: 'Habis', 'Menipis', or 'Tersedia'
     *
     * @return string
     */
    public function getStockStatusLabel(): string
    {
        if ($this->stok <= 0) {
            return 'Habis';
        }

        $stokMinimum = $this->stok_minimum ?? 10;

        if ($this->stok <= $stokMinimum) {
            return 'Menipis';
        }

        return 'Tersedia';
    }

    /**
     * Get stock status badge color for display
     * Returns: 'danger', 'warning', or 'success'
     *
     * @return string
     */
    public function getStockStatusColor(): string
    {
        if ($this->stok <= 0) {
            return 'danger'; // red
        }

        $stokMinimum = $this->stok_minimum ?? 10;

        if ($this->stok <= $stokMinimum) {
            return 'warning'; // yellow
        }

        return 'success'; // green
    }
}
