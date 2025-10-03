<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $fillable = [
        'nama_poli',
        'keterangan',
    ];

    /**
     * Get the dokters that belong to this poli.
     */
    public function dokters()
    {
        return $this->hasMany(User::class, 'id_poli');
    }
}
