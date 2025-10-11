<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPeriksa extends Model
{
    protected $fillable = [
        'id_dokter',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'aktif',
    ];

    protected $casts = [
        'jam_mulai' => 'datetime:H:i',
        'jam_selesai' => 'datetime:H:i',
    ];

    /**
     * Get the dokter that owns the jadwal periksa.
     */
    public function dokter()
    {
        return $this->belongsTo(User::class, 'id_dokter');
    }

    /**
     * Get the daftar polis for the jadwal periksa.
     */
    public function daftarPolis()
    {
        return $this->hasMany(DaftarPoli::class, 'id_jadwal');
    }
}
