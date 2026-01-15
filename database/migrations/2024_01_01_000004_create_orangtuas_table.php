<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orangtuas', function (Blueprint $table) {
            $table->id();
            $table->string('no_id')->unique(); // TPQH-XXXXX
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->enum('status_ayah', ['Hidup', 'Wafat'])->default('Hidup');
            $table->enum('status_ibu', ['Hidup', 'Wafat'])->default('Hidup');
            $table->enum('status_anak', ['Dalam Asuhan OT', 'Anak Yatim', 'Anak Piatu', 'Anak Yatim Piatu'])->default('Dalam Asuhan OT');
            $table->string('no_hp')->nullable();
            $table->string('no_hp_alternatif')->nullable();
            $table->string('email')->nullable();
            $table->text('alamat')->nullable();
            $table->foreignId('kelurahan_id')->nullable()->constrained('kelurahans')->nullOnDelete();
            $table->string('kode_pos')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orangtuas');
    }
};
