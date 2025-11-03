<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Model Poli - Mengelola data poliklinik
 */
class Poli extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_poli',
        'keterangan',
    ];

    public function dokters()
    {
        return $this->hasMany(User::class, 'id_poli')->where('role', 'dokter');
    }

    // Relasi ke jadwal periksa
    public function jadwalPeriksa()
    {
        return $this->hasManyThrough(JadwalPeriksa::class, User::class, 'id_poli', 'id_dokter');
    }
}
