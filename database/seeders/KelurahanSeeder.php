<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kelurahan di Kecamatan Ternate Selatan
        $kelurahans = [
            // Ternate Selatan (kecamatan_id: 1)
            ['kecamatan_id' => 1, 'kode' => 'TRN-01-001', 'nama' => 'Bastiong'],
            ['kecamatan_id' => 1, 'kode' => 'TRN-01-002', 'nama' => 'Stadion'],
            ['kecamatan_id' => 1, 'kode' => 'TRN-01-003', 'nama' => 'Takoma'],
            ['kecamatan_id' => 1, 'kode' => 'TRN-01-004', 'nama' => 'Tanah Tinggi'],
            ['kecamatan_id' => 1, 'kode' => 'TRN-01-005', 'nama' => 'Tanah Tinggi Barat'],
            ['kecamatan_id' => 1, 'kode' => 'TRN-01-006', 'nama' => 'Tanah Tinggi Timur'],

            // Ternate Tengah (kecamatan_id: 2)
            ['kecamatan_id' => 2, 'kode' => 'TRN-02-001', 'nama' => 'Gamalama'],
            ['kecamatan_id' => 2, 'kode' => 'TRN-02-002', 'nama' => 'Makassar Barat'],
            ['kecamatan_id' => 2, 'kode' => 'TRN-02-003', 'nama' => 'Makassar Timur'],
            ['kecamatan_id' => 2, 'kode' => 'TRN-02-004', 'nama' => 'Muhajirin'],
            ['kecamatan_id' => 2, 'kode' => 'TRN-02-005', 'nama' => 'Soa Sio'],
            ['kecamatan_id' => 2, 'kode' => 'TRN-02-006', 'nama' => 'Santiong'],

            // Ternate Utara (kecamatan_id: 3)
            ['kecamatan_id' => 3, 'kode' => 'TRN-03-001', 'nama' => 'Salamate'],
            ['kecamatan_id' => 3, 'kode' => 'TRN-03-002', 'nama' => 'Sangaji'],
            ['kecamatan_id' => 3, 'kode' => 'TRN-03-003', 'nama' => 'Sulamadaha'],
            ['kecamatan_id' => 3, 'kode' => 'TRN-03-004', 'nama' => 'Tabam'],
            ['kecamatan_id' => 3, 'kode' => 'TRN-03-005', 'nama' => 'Tabona'],
            ['kecamatan_id' => 3, 'kode' => 'TRN-03-006', 'nama' => 'Tarau'],

            // Ternate Barat (kecamatan_id: 4)
            ['kecamatan_id' => 4, 'kode' => 'TRN-04-001', 'nama' => 'Kulaba'],
            ['kecamatan_id' => 4, 'kode' => 'TRN-04-002', 'nama' => 'Salero'],
            ['kecamatan_id' => 4, 'kode' => 'TRN-04-003', 'nama' => 'Sangaji Utara'],
            ['kecamatan_id' => 4, 'kode' => 'TRN-04-004', 'nama' => 'Soasio'],
            ['kecamatan_id' => 4, 'kode' => 'TRN-04-005', 'nama' => 'Toboko'],

            // Ternate Timur (kecamatan_id: 5)
            ['kecamatan_id' => 5, 'kode' => 'TRN-05-001', 'nama' => 'Tobona'],
            ['kecamatan_id' => 5, 'kode' => 'TRN-05-002', 'nama' => 'Dufa-Dufa'],
            ['kecamatan_id' => 5, 'kode' => 'TRN-05-003', 'nama' => 'Kalumpang'],
            ['kecamatan_id' => 5, 'kode' => 'TRN-05-004', 'nama' => 'Kasturian'],
            ['kecamatan_id' => 5, 'kode' => 'TRN-05-005', 'nama' => 'Maliaro'],
            ['kecamatan_id' => 5, 'kode' => 'TRN-05-006', 'nama' => 'Moya'],

            // Pulau Ternate (kecamatan_id: 6)
            ['kecamatan_id' => 6, 'kode' => 'TRN-06-001', 'nama' => 'Dorpedu'],
            ['kecamatan_id' => 6, 'kode' => 'TRN-06-002', 'nama' => 'Foramadiahi'],
            ['kecamatan_id' => 6, 'kode' => 'TRN-06-003', 'nama' => 'Kastela'],
            ['kecamatan_id' => 6, 'kode' => 'TRN-06-004', 'nama' => 'Takome'],
            ['kecamatan_id' => 6, 'kode' => 'TRN-06-005', 'nama' => 'Tolire'],
            ['kecamatan_id' => 6, 'kode' => 'TRN-06-006', 'nama' => 'Tubo'],

            // Moti (kecamatan_id: 7)
            ['kecamatan_id' => 7, 'kode' => 'TRN-07-001', 'nama' => 'Figur'],
            ['kecamatan_id' => 7, 'kode' => 'TRN-07-002', 'nama' => 'Moti Kota'],
            ['kecamatan_id' => 7, 'kode' => 'TRN-07-003', 'nama' => 'Tafure'],

            // Pulau Batang Dua (kecamatan_id: 8)
            ['kecamatan_id' => 8, 'kode' => 'TRN-08-001', 'nama' => 'Batang Dua'],
            ['kecamatan_id' => 8, 'kode' => 'TRN-08-002', 'nama' => 'Guruaping'],
        ];

        foreach ($kelurahans as $kelurahan) {
            DB::table('kelurahans')->insert([
                'kecamatan_id' => $kelurahan['kecamatan_id'],
                'kode' => $kelurahan['kode'],
                'nama' => $kelurahan['nama'],
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
