<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarPoli extends Model
{
    protected $fillable = [
        'id_pasien',
        'id_jadwal',
        'id_periksa',
        'keluhan',
        'no_antrian',
    ];

    /**
     * Get the pasien that owns the daftar poli.
     */
    public function pasien()
    {
        return $this->belongsTo(User::class, 'id_pasien');
    }

    /**
     * Get the jadwal periksa that owns the daftar poli.
     */
    public function jadwalPeriksa()
    {
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal');
    }

    /**
     * Get the periksa for the daftar poli.
     */
    public function periksa()
    {
        return $this->belongsTo(Periksa::class, 'id_periksa');
    }
}
