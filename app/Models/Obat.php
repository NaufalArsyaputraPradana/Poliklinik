<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $fillable = [
        'nama_obat',
        'kemasan',
        'harga',
    ];

    /**
     * Get the detail periksas for the obat.
     */
    public function detailPeriksas()
    {
        return $this->hasMany(DetailPeriksa::class, 'id_obat');
    }

    /**
     * Get the periksas through detail periksas.
     */
    public function periksas()
    {
        return $this->belongsToMany(Periksa::class, 'detail_periksas', 'id_obat', 'id_periksa');
    }
}
