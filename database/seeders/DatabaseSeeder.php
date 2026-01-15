<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([KecamatanSeeder::class, KelurahanSeeder::class]);

        // Create Admin User
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@tpq-khairunnisa.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Create Guru User
        $guruUser = User::create([
            'name' => 'Ustadz Ahmad',
            'email' => 'guru@tpq-khairunnisa.com',
            'password' => Hash::make('password'),
            'role' => 'guru',
            'is_active' => true,
        ]);

        // Create Kelas
        $kelasData = [['nama_kelas' => 'Iqra 1', 'kode_kelas' => 'IQRA1', 'deskripsi' => 'Kelas Iqra Jilid 1'], ['nama_kelas' => 'Iqra 2', 'kode_kelas' => 'IQRA2', 'deskripsi' => 'Kelas Iqra Jilid 2'], ['nama_kelas' => 'Iqra 3', 'kode_kelas' => 'IQRA3', 'deskripsi' => 'Kelas Iqra Jilid 3'], ['nama_kelas' => 'Iqra 4', 'kode_kelas' => 'IQRA4', 'deskripsi' => 'Kelas Iqra Jilid 4'], ['nama_kelas' => 'Iqra 5', 'kode_kelas' => 'IQRA5', 'deskripsi' => 'Kelas Iqra Jilid 5'], ['nama_kelas' => 'Iqra 6', 'kode_kelas' => 'IQRA6', 'deskripsi' => 'Kelas Iqra Jilid 6'], ['nama_kelas' => 'Iqra 7', 'kode_kelas' => 'IQRA7', 'deskripsi' => 'Kelas Iqra Jilid 7 (Tadarus)'], ['nama_kelas' => 'Al-Quran', 'kode_kelas' => 'QURAN', 'deskripsi' => 'Kelas Al-Quran']];

        foreach ($kelasData as $kelas) {
            Kelas::create($kelas);
        }

        // Create Sample Guru
        Guru::create([
            'user_id' => $guruUser->id,
            'nama' => 'Ustadz Ahmad',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Ternate',
            'tanggal_lahir' => '1985-05-15',
            'pendidikan' => 'S1 Pendidikan Agama Islam',
            'alamat' => 'Jl. Sultan Khairun No. 10',
            'kota' => 'Ternate',
            'no_hp' => '081234567890',
            'email' => 'guru@tpq-khairunnisa.com',
            'kelas_id' => 1,
            'tanggal_bergabung' => '2020-01-01',
            'is_active' => true,
        ]);

        // Create Settings
        $settings = [['key' => 'app_name', 'value' => 'TPQ Khairunnisa', 'type' => 'text', 'group' => 'general'], ['key' => 'app_address', 'value' => 'Jl. Contoh No. 123, Ternate', 'type' => 'text', 'group' => 'general'], ['key' => 'app_phone', 'value' => '0921-123456', 'type' => 'text', 'group' => 'general'], ['key' => 'app_email', 'value' => 'info@tpq-khairunnisa.com', 'type' => 'text', 'group' => 'general']];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
