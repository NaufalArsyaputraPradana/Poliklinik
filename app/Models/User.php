<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'alamat',
        'id_poli',
        'no_ktp',
        'no_hp',
        'no_rm',
        'role',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the poli that the user belongs to.
     */
    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }

    /**
     * Get the jadwal periksas for the dokter.
     */
    public function jadwalPeriksas()
    {
        return $this->hasMany(JadwalPeriksa::class, 'id_dokter');
    }

    /**
     * Get the daftar polis for the pasien.
     */
    public function daftarPolis()
    {
        return $this->hasMany(DaftarPoli::class, 'id_pasien');
    }

    /**
     * Get the formatted name with role
     */
    public function getDisplayNameAttribute()
    {
        return $this->nama . ' (' . ucfirst($this->role) . ')';
    }

    /**
     * Get the role label
     */
    public function getRoleLabelAttribute()
    {
        return match ($this->role) {
            'admin' => 'Administrator',
            'dokter' => 'Dokter',
            'pasien' => 'Pasien',
            default => 'Unknown'
        };
    }

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is dokter
     */
    public function isDokter()
    {
        return $this->role === 'dokter';
    }

    /**
     * Check if user is pasien
     */
    public function isPasien()
    {
        return $this->role === 'pasien';
    }

    /**
     * Scope to get only admin users
     */
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    /**
     * Scope to get only dokter users
     */
    public function scopeDokters($query)
    {
        return $query->where('role', 'dokter');
    }

    /**
     * Scope to get only pasien users
     */
    public function scopePasiens($query)
    {
        return $query->where('role', 'pasien');
    }
}
