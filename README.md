# TPQ Khairunnisa - Sistem Manajemen Taman Pendidikan Al-Quran

Sistem informasi manajemen TPQ berbasis Laravel dengan fitur lengkap untuk mengelola data santri, guru, orang tua, dan
progress pembelajaran.

## Fitur Utama

- 🏠 Dashboard dengan statistik
- 👨‍🎓 Manajemen Data Santri
- 👨‍🏫 Manajemen Data Guru
- 👨‍👩‍👧 Manajemen Data Orang Tua
- 📊 Laporan Progress Santri
- 📢 Pengumuman via WhatsApp
- 📰 Kelola Berita
- 📈 Tracking Progress Pembelajaran (Iqra 1-7, Al-Quran)

## Teknologi

- Laravel 11
- MySQL
- Laravel Breeze (Authentication)
- Bootstrap 5
- DataTables
- Chart.js

## Persyaratan Sistem

- PHP >= 8.2
- Composer
- MySQL >= 5.7
- Node.js >= 18

## Instalasi

### 1. Clone Repository
```bash
git clone <repository-url>
    cd tpq-khairunnisa
    ```

    ### 2. Install Dependencies
    ```bash
    composer install
    npm install
    ```

    ### 3. Konfigurasi Environment
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

    ### 4. Konfigurasi Database
    Edit file `.env` dan sesuaikan konfigurasi database:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=tpq_khairunnisa
    DB_USERNAME=root
    DB_PASSWORD=
    ```

    ### 5. Buat Database
    ```sql
    CREATE DATABASE tpq_khairunnisa;
    ```

    ### 6. Jalankan Migration & Seeder
    ```bash
    php artisan migrate
    php artisan db:seed
    ```

    ### 7. Buat Storage Link
    ```bash
    php artisan storage:link
    ```

    ### 8. Build Assets
    ```bash
    npm run build
    ```

    ### 9. Jalankan Server
    ```bash
    php artisan serve
    ```

    Akses aplikasi di: http://localhost:8000

    ## Akun Default

    ### Admin
    - Email: admin@tpq-khairunnisa.com
    - Password: password

    ### Guru
    - Email: guru@tpq-khairunnisa.com
    - Password: password

    ## Struktur Database

    ### Tabel Utama
    - `users` - Data user untuk autentikasi
    - `santris` - Data santri
    - `gurus` - Data guru/ustadz
    - `orangtuas` - Data orang tua/wali
    - `kelas` - Data kelas/halaqah
    - `progress_santris` - Progress pembelajaran santri
    - `pengumumans` - Data pengumuman
    - `beritas` - Data berita

    ## Screenshot

    (Tambahkan screenshot aplikasi di sini)

    ## Lisensi

    MIT License

    ## Kontributor

    TPQ Khairunnisa Ternate


    Akun Default:

    Admin: admin@tpq-khairunnisa.com / password
    Guru: guru@tpq-khairunnisa.com / password
