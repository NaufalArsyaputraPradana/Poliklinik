<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periksa extends Model
{
    protected $fillable = [
        'id_daftar_poli',
        'tgl_periksa',
        'catatan',
        'biaya_periksa',
    ];

    protected $casts = [
        'tgl_periksa' => 'datetime',
    ];

    /**
     * Get the daftar poli that owns the periksa.
     */
    public function daftarPoli()
    {
        return $this->belongsTo(DaftarPoli::class, 'id_daftar_poli');
    }

    /**
     * Get the detail periksas for the periksa.
     */
    public function detailPeriksas()
    {
        return $this->hasMany(DetailPeriksa::class, 'id_periksa');
    }

    /**
     * Get the obats through detail periksas.
     */
    public function obats()
    {
        return $this->belongsToMany(Obat::class, 'detail_periksas', 'id_periksa', 'id_obat');
    }
}
