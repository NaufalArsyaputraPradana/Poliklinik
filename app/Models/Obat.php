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

    // STOCK MANAGEMENT METHODS (Capstone Feature)

    /**
     * Check if stock is empty
     *
     * @return bool
     */
    public function isStokHabis(): bool
    {
        return $this->stok <= 0;
    }

    /**
     * Check if stock is running low (below minimum threshold)
     *
     * @return bool
     */
    public function isStokMenipis(): bool
    {
        return $this->stok > 0 && $this->stok <= $this->stok_minimum;
    }

    /**
     * Get stock status indicator
     * Returns: 'habis', 'menipis', or 'aman'
     *
     * @return string
     */
    public function getStokStatus(): string
    {
        if ($this->isStokHabis()) {
            return 'habis';
        } elseif ($this->isStokMenipis()) {
            return 'menipis';
        }
        return 'aman';
    }

    /**
     * Get stock status badge HTML class
     *
     * @return string
     */
    public function getStokBadgeClass(): string
    {
        $status = $this->getStokStatus();
        return match ($status) {
            'habis' => 'badge bg-danger',
            'menipis' => 'badge bg-warning text-dark',
            'aman' => 'badge bg-success',
            default => 'badge bg-secondary'
        };
    }

    /**
     * Increase stock by specified amount
     *
     * @param int $jumlah
     * @return bool
     */
    public function increaseStock(int $jumlah): bool
    {
        if ($jumlah <= 0) {
            return false;
        }

        $this->stok += $jumlah;
        return $this->save();
    }

    /**
     * Decrease stock by specified amount with validation
     *
     * @param int $jumlah
     * @return bool
     */
    public function decreaseStock(int $jumlah): bool
    {
        if ($jumlah <= 0 || $this->stok < $jumlah) {
            return false;
        }

        $this->stok -= $jumlah;
        return $this->save();
    }

    /**
     * Set stock to specific value
     *
     * @param int $jumlah
     * @return bool
     */
    public function setStock(int $jumlah): bool
    {
        if ($jumlah < 0) {
            return false;
        }

        $this->stok = $jumlah;
        return $this->save();
    }

    /**
     * Check if stock is sufficient for requested amount
     *
     * @param int $jumlah
     * @return bool
     */
    public function hasStokCukup(int $jumlah): bool
    {
        return $this->stok >= $jumlah;
    }
}
