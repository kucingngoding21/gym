<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaftarIjinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('daftar_ijin')->insert([
            'id' => 1,
            'instruktur_id' => 4,
            'tanggal_pengajuan' => '2023-05-15',
            'status' => 'Menunggu Persejutuan',
        ]);
    }
}
