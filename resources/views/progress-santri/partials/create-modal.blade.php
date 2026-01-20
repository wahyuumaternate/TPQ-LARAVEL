<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Progress Santri
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('progress-santri.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Santri -->
                        <div class="col-md-6">
                            <label for="santri_id" class="form-label">
                                Santri <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('santri_id') is-invalid @enderror" id="santri_id"
                                name="santri_id" required>
                                <option value="">Pilih Santri</option>
                                @foreach ($santris as $santri)
                                    <option value="{{ $santri->id }}"
                                        {{ old('santri_id') == $santri->id ? 'selected' : '' }}>
                                        {{ $santri->nama }} - {{ $santri->no_induk ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('santri_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Guru -->
                        <div class="col-md-6">
                            <label for="guru_id" class="form-label">Guru/Pengajar</label>
                            <select class="form-select @error('guru_id') is-invalid @enderror" id="guru_id"
                                name="guru_id">
                                <option value="">Pilih Guru</option>
                                @foreach ($gurus as $guru)
                                    <option value="{{ $guru->id }}"
                                        {{ old('guru_id') == $guru->id ? 'selected' : '' }}>
                                        {{ $guru->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('guru_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tanggal -->
                        <div class="col-md-4">
                            <label for="tanggal" class="form-label">
                                Tanggal <span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Jilid -->
                        <div class="col-md-4">
                            <label for="jilid" class="form-label">
                                Jilid <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('jilid') is-invalid @enderror" id="jilid"
                                name="jilid" required>
                                <option value="">Pilih Jilid</option>
                                <option value="Iqra 1" {{ old('jilid') == 'Iqra 1' ? 'selected' : '' }}>Iqra 1</option>
                                <option value="Iqra 2" {{ old('jilid') == 'Iqra 2' ? 'selected' : '' }}>Iqra 2</option>
                                <option value="Iqra 3" {{ old('jilid') == 'Iqra 3' ? 'selected' : '' }}>Iqra 3</option>
                                <option value="Iqra 4" {{ old('jilid') == 'Iqra 4' ? 'selected' : '' }}>Iqra 4</option>
                                <option value="Iqra 5" {{ old('jilid') == 'Iqra 5' ? 'selected' : '' }}>Iqra 5</option>
                                <option value="Iqra 6" {{ old('jilid') == 'Iqra 6' ? 'selected' : '' }}>Iqra 6</option>
                                <option value="Al-Quran" {{ old('jilid') == 'Al-Quran' ? 'selected' : '' }}>Al-Quran
                                </option>
                            </select>
                            @error('jilid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Halaman -->
                        <div class="col-md-4">
                            <label for="halaman" class="form-label">Halaman</label>
                            <input type="text" class="form-control @error('halaman') is-invalid @enderror"
                                id="halaman" name="halaman" value="{{ old('halaman') }}" placeholder="Contoh: 15">
                            @error('halaman')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Surah -->
                        <div class="col-md-4">
                            <label for="surah" class="form-label">Surah</label>
                            <input type="text" class="form-control @error('surah') is-invalid @enderror"
                                id="surah" name="surah" value="{{ old('surah') }}"
                                placeholder="Contoh: Al-Fatihah">
                            @error('surah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Dari Ayat -->
                        <div class="col-md-4">
                            <label for="dari_ayat" class="form-label">Dari Ayat</label>
                            <input type="text" class="form-control @error('dari_ayat') is-invalid @enderror"
                                id="dari_ayat" name="dari_ayat" value="{{ old('dari_ayat') }}" placeholder="Contoh: 1">
                            @error('dari_ayat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Sampai Ayat -->
                        <div class="col-md-4">
                            <label for="sampai_ayat" class="form-label">Sampai Ayat</label>
                            <input type="text" class="form-control @error('sampai_ayat') is-invalid @enderror"
                                id="sampai_ayat" name="sampai_ayat" value="{{ old('sampai_ayat') }}"
                                placeholder="Contoh: 7">
                            @error('sampai_ayat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-12">
                            <label for="status" class="form-label">
                                Status <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status"
                                name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="lancar" {{ old('status') == 'lancar' ? 'selected' : '' }}>Lancar
                                </option>
                                <option value="kurang_lancar"
                                    {{ old('status') == 'kurang_lancar' ? 'selected' : '' }}>Kurang Lancar</option>
                                <option value="mengulang" {{ old('status') == 'mengulang' ? 'selected' : '' }}>
                                    Mengulang</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Hafalan Checkbox -->
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="hafalan" name="hafalan"
                                    value="1" {{ old('hafalan') ? 'checked' : '' }}>
                                <label class="form-check-label" for="hafalan">
                                    <i class="bi bi-star-fill text-warning"></i> Ada Hafalan
                                </label>
                            </div>
                        </div>

                        <!-- Hafalan Fields (Hidden by default) -->
                        <div id="hafalanFields" style="display: {{ old('hafalan') ? 'block' : 'none' }};">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="hafalan_surah" class="form-label">
                                        Surah Hafalan
                                    </label>
                                    <input type="text"
                                        class="form-control @error('hafalan_surah') is-invalid @enderror"
                                        id="hafalan_surah" name="hafalan_surah" value="{{ old('hafalan_surah') }}"
                                        placeholder="Contoh: Al-Ikhlas">
                                    @error('hafalan_surah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="hafalan_ayat_dari" class="form-label">Ayat Dari</label>
                                    <input type="number"
                                        class="form-control @error('hafalan_ayat_dari') is-invalid @enderror"
                                        id="hafalan_ayat_dari" name="hafalan_ayat_dari"
                                        value="{{ old('hafalan_ayat_dari') }}" min="1" placeholder="1">
                                    @error('hafalan_ayat_dari')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="hafalan_ayat_sampai" class="form-label">Ayat Sampai</label>
                                    <input type="number"
                                        class="form-control @error('hafalan_ayat_sampai') is-invalid @enderror"
                                        id="hafalan_ayat_sampai" name="hafalan_ayat_sampai"
                                        value="{{ old('hafalan_ayat_sampai') }}" min="1" placeholder="4">
                                    @error('hafalan_ayat_sampai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Catatan -->
                        <div class="col-12">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan" name="catatan" rows="3"
                                placeholder="Catatan tambahan tentang progress santri...">{{ old('catatan') }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
