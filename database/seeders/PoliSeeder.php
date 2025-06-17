<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Import class DB
use Carbon\Carbon; // Import Carbon untuk timestamps

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('polis')->insert([
            [
                'nama' => 'Poli Gigi',
                'deskripsi' => 'Melayani pemeriksaan, pengobatan, dan perawatan gigi serta mulut.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Poli Anak',
                'deskripsi' => 'Melayani pemeriksaan dan pengobatan kesehatan anak dari bayi hingga remaja.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Poli Penyakit Dalam',
                'deskripsi' => 'Melayani diagnosis dan pengobatan penyakit pada orang dewasa, seperti diabetes, hipertensi, dan penyakit jantung.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}