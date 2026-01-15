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
        Schema::create('progress_santris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santris')->cascadeOnDelete();
            $table->foreignId('guru_id')->nullable()->constrained('gurus')->nullOnDelete();
            $table->date('tanggal');
            $table->string('jilid'); // Iqra 1-7, Al-Quran
            $table->string('halaman')->nullable();
            $table->string('ayat')->nullable();
            $table->string('surah')->nullable();
            $table->enum('nilai', ['A', 'B', 'C', 'D', 'E'])->nullable();
            $table->enum('status', ['lancar', 'kurang_lancar', 'mengulang'])->default('lancar');
            $table->text('catatan')->nullable();
            $table->boolean('hafalan')->default(false);
            $table->string('hafalan_surah')->nullable();
            $table->integer('hafalan_ayat_dari')->nullable();
            $table->integer('hafalan_ayat_sampai')->nullable();
            $table->timestamps();

            $table->index(['santri_id', 'tanggal']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_santris');
    }
};
