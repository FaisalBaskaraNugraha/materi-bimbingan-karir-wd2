<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Obat; // Pastikan ini mengarah ke model Obat Anda
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        // Secara default, SoftDeletes hanya akan mengambil data yang deleted_at-nya NULL
        $obats = Obat::all();

        return view('dokter.obat.index')->with([
            'obats' => $obats,
        ]);
    }

    public function create(){
        return view('dokter.obat.create');
    }

    public function edit($id)
    {
        // find() juga akan mengabaikan data yang soft deleted secara default
        $obat = Obat::find($id);

        // Tambahkan pengecekan jika obat tidak ditemukan (termasuk yang soft deleted)
        if (!$obat) {
            return redirect()->route('dokter.obat.index')->with('error', 'Obat tidak ditemukan.');
        }

        return view('dokter.obat.edit')->with([
            'obat' => $obat,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        Obat::create([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);

        return redirect()->route('dokter.obat.index')->with('status', 'obat-created');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        $obat = Obat::find($id);

        // Tambahkan pengecekan jika obat tidak ditemukan
        if (!$obat) {
            return redirect()->route('dokter.obat.index')->with('error', 'Obat tidak ditemukan.');
        }

        $obat->update([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);

        return redirect()->route('dokter.obat.index')->with('status', 'obat-updated');
    }

    public function destroy($id)
    {
        $obat = Obat::find($id);

        // Tambahkan pengecekan jika obat tidak ditemukan
        if (!$obat) {
            return redirect()->route('dokter.obat.index')->with('error', 'Obat tidak ditemukan.');
        }

        $obat->delete(); // Ini akan melakukan soft delete

        return redirect()->route('dokter.obat.index')->with('status', 'Obat berhasil dihapus (soft delete).');
    }
}