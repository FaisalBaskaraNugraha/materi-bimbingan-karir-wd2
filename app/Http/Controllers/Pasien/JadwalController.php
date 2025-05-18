<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa;

class JadwalController extends Controller {
    public function getByDokter($id_dokter){
        $jadwals = JadwalPeriksa::where()
    }
}
