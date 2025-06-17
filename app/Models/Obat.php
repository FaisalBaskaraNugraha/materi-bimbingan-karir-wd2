<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes; // Tambahkan ini

class Obat extends Model
{
    use HasFactory, SoftDeletes; // Tambahkan SoftDeletes di sini

    protected $fillable = [
        'nama_obat',
        'kemasan',
        'harga',
    ];

    public function detailPeriksas():HasMany
    {
        return $this->hasMany(DetailPeriksa::class, 'id_obat');
    }
}