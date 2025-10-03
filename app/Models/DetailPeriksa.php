<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPeriksa extends Model
{
    protected $fillable = [
        'id_periksa',
        'id_obat',
    ];

    /**
     * Get the periksa that owns the detail periksa.
     */
    public function periksa()
    {
        return $this->belongsTo(Periksa::class, 'id_periksa');
    }

    /**
     * Get the obat that owns the detail periksa.
     */
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }
}
