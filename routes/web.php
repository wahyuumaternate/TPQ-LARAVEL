<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\OrangtuaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ProgressSantriController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ============ PUBLIC ROUTES ============

// Landing Page
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/tentang', [LandingController::class, 'about'])->name('landing.about');
Route::get('/kontak', [LandingController::class, 'contact'])->name('landing.contact');
Route::post('/kontak', [LandingController::class, 'contactSubmit'])->name('landing.contact.submit');
Route::get('/data-santri', [LandingController::class, 'dataSantri'])->name('landing.data-santri');

// Public News
Route::prefix('news')
    ->name('news.')
    ->group(function () {
        Route::get('/', [BeritaController::class, 'publicIndex'])->name('index');
        Route::get('/{berita:slug}', [BeritaController::class, 'publicShow'])->name('show');
    });

// ============ AUTHENTICATED ROUTES ============

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ============ SANTRI ============

    Route::prefix('admin/santri')
        ->name('santri.')
        ->group(function () {
            // Custom routes first
            Route::get('/statistics', [SantriController::class, 'statistics'])->name('statistics');
            Route::get('/export', [SantriController::class, 'export'])->name('export');

            // CRUD routes
            Route::get('/', [SantriController::class, 'index'])->name('index');
            Route::get('/create', [SantriController::class, 'create'])->name('create');
            Route::post('/', [SantriController::class, 'store'])->name('store');
            Route::get('/{santri}', [SantriController::class, 'show'])->name('show');
            Route::get('/{santri}/edit', [SantriController::class, 'edit'])->name('edit');
            Route::put('/{santri}', [SantriController::class, 'update'])->name('update');
            Route::delete('/{santri}', [SantriController::class, 'destroy'])->name('destroy');
        });

    // ============ GURU ============
    Route::get('guru/list', [GuruController::class, 'list'])->name('guru.list');
    Route::get('guru/export', [GuruController::class, 'export'])->name('guru.export');
    Route::resource('guru', GuruController::class);

    // ============ ORANGTUA ============
    Route::resource('orangtua', OrangtuaController::class);
    Route::get('orangtua/list', [OrangtuaController::class, 'list'])->name('orangtua.list');

    // ============ KELAS ============
    Route::resource('kelas', KelasController::class);

    // ============ PROGRESS SANTRI ============
    Route::prefix('progress')
        ->name('progress-santri.')
        ->group(function () {
            Route::get('/', [ProgressSantriController::class, 'index'])->name('index');
            Route::get('/create', [ProgressSantriController::class, 'create'])->name('create');
            Route::post('/', [ProgressSantriController::class, 'store'])->name('store');
            Route::get('/santri/{santri}', [ProgressSantriController::class, 'bySantri'])->name('by-santri');
            Route::get('/{progress}', [ProgressSantriController::class, 'show'])->name('show');
            Route::get('/{progress}/edit', [ProgressSantriController::class, 'edit'])->name('edit');
            Route::put('/{progress}', [ProgressSantriController::class, 'update'])->name('update');
            Route::delete('/{progress}', [ProgressSantriController::class, 'destroy'])->name('destroy');
        });

    // ============ PENGUMUMAN ============
    Route::resource('pengumuman', PengumumanController::class);
    Route::post('pengumuman/{pengumuman}/resend-wa', [PengumumanController::class, 'resendWhatsApp'])->name('pengumuman.resend-wa');

    // ============ BERITA (Admin) ============
    Route::resource('berita', BeritaController::class);
    Route::post('berita/{berita}/toggle-publish', [BeritaController::class, 'togglePublish'])->name('berita.toggle-publish');

    // ============ LAPORAN ============
    Route::prefix('laporan')
        ->name('laporan.')
        ->group(function () {
            Route::get('/santri-per-kelas', [LaporanController::class, 'santriPerKelas'])->name('santri-per-kelas');
            Route::get('/progress-bulanan', [LaporanController::class, 'progressBulanan'])->name('progress-bulanan');
            Route::get('/absensi', [LaporanController::class, 'absensi'])->name('absensi');
            Route::get('/statistik', [LaporanController::class, 'statistik'])->name('statistik');
            Route::get('/export', [LaporanController::class, 'export'])->name('export');
        });

    // ============ PROFILE ============
    Route::prefix('profile')
        ->name('profile.')
        ->group(function () {
            Route::get('/', [ProfileController::class, 'edit'])->name('edit');
            Route::patch('/', [ProfileController::class, 'update'])->name('update');
            Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
        });
});

// ============ API ROUTES (untuk AJAX) ============
Route::get('/api/kelurahan/{kecamatan_id}', [SantriController::class, 'getKelurahan'])->name('api.kelurahan');
Route::get('/api/orangtua/kelurahan/{kecamatan_id}', [OrangtuaController::class, 'getKelurahan'])->name('api.orangtua.kelurahan');
Route::get('/api/santri/kelurahan/{kecamatan_id}', [SantriController::class, 'getKelurahan'])->name('api.santri.kelurahan');

require __DIR__ . '/auth.php';
