<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Import HasMany

class Poli extends Model
{
    use HasFactory;

    protected $table = 'polis'; // Pastikan nama tabelnya 'polis'

    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    /**
     * Get the users (doctors) for the poli.
     */
    public function doctors(): HasMany
    {
        // Asumsi model untuk dokter adalah 'User' dan memiliki 'id_poli'
        // Kita akan memodifikasi tabel users di langkah selanjutnya
        return $this->hasMany(User::class, 'id_poli');
    }
}