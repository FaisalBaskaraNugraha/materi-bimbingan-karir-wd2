<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo; //Import BelongsTo
use Illuminate\Database\Eloquent\Relations\HasMany;   // import HasMany

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',      
        'email',
        'password',
        'role',      
        'alamat',   
        'no_ktp',    
        'no_hp',     
        'no_rm',     
        'id_poli',   // Ganti 'poli' dengan 'id_poli'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected function casts(): array // Menggunakan protected function casts(): array sesuai Laravel 10+
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // --- Relasi yang Sudah Ada ---

    public function jadwalPeriksas(): HasMany // Menambahkan tipe return hint
    {
        return $this->hasMany(JadwalPeriksa::class, 'id_dokter');
    }

    public function janjiPeriksas(): HasMany // Menambahkan tipe return hint
    {
        return $this->hasMany(JanjiPeriksa::class, 'id_pasien');
    }

    // --- Relasi Baru untuk Poli ---

    /**
     * Get the poli that owns the user (doctor).
     */
    public function poli(): BelongsTo
    {
        // Mendefinisikan relasi Many-to-One dengan model Poli.
        // Laravel secara otomatis akan mencari foreign key 'id_poli' di tabel users
        // dan primary key 'id' di tabel polis.
        return $this->belongsTo(Poli::class, 'id_poli');
    }
}
