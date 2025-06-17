<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom 'poli' lama jika ada
            if (Schema::hasColumn('users', 'poli')) {
                $table->dropColumn('poli');
            }

            // Tambahkan foreign key id_poli
            $table->foreignId('id_poli')
                  ->nullable() // Boleh null jika dokter belum punya poli
                  ->after('password') // Posisikan setelah password (opsional)
                  ->constrained('polis') // Mereferensi ke tabel 'polis'
                  ->onDelete('set null'); // Jika poli dihapus, id_poli di user jadi null
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus foreign key terlebih dahulu
            $table->dropConstrainedForeignId('id_poli');
            // Kembalikan kolom 'poli' jika sebelumnya ada (opsional, sesuaikan dengan kebutuhan aplikasi Anda)
            // $table->string('poli')->nullable()->after('password');
        });
    }
};