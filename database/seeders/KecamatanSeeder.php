<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kecamatans = [['kode' => 'TRN-01', 'nama' => 'Ternate Selatan'], ['kode' => 'TRN-02', 'nama' => 'Ternate Tengah'], ['kode' => 'TRN-03', 'nama' => 'Ternate Utara'], ['kode' => 'TRN-04', 'nama' => 'Ternate Barat'], ['kode' => 'TRN-05', 'nama' => 'Ternate Timur'], ['kode' => 'TRN-06', 'nama' => 'Pulau Ternate'], ['kode' => 'TRN-07', 'nama' => 'Moti'], ['kode' => 'TRN-08', 'nama' => 'Pulau Batang Dua']];

        foreach ($kecamatans as $kecamatan) {
            DB::table('kecamatans')->insert([
                'kode' => $kecamatan['kode'],
                'nama' => $kecamatan['nama'],
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
