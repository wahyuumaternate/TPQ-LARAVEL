<!-- Edit Modal -->
<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title">
                    <i class="bi bi-pencil me-2"></i>Edit Progress Santri
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('progress-santri.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Santri -->
                        <div class="col-md-6">
                            <label for="edit_santri_id{{ $item->id }}" class="form-label">
                                Santri <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" id="edit_santri_id{{ $item->id }}" name="santri_id"
                                required>
                                <option value="">Pilih Santri</option>
                                @foreach ($santris as $santri)
                                    <option value="{{ $santri->id }}"
                                        {{ $item->santri_id == $santri->id ? 'selected' : '' }}>
                                        {{ $santri->nama }} - {{ $santri->no_induk ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Guru -->
                        <div class="col-md-6">
                            <label for="edit_guru_id{{ $item->id }}" class="form-label">Guru/Pengajar</label>
                            <select class="form-select" id="edit_guru_id{{ $item->id }}" name="guru_id">
                                <option value="">Pilih Guru</option>
                                @foreach ($gurus as $guru)
                                    <option value="{{ $guru->id }}"
                                        {{ $item->guru_id == $guru->id ? 'selected' : '' }}>
                                        {{ $guru->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tanggal -->
                        <div class="col-md-4">
                            <label for="edit_tanggal{{ $item->id }}" class="form-label">
                                Tanggal <span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control" id="edit_tanggal{{ $item->id }}"
                                name="tanggal" value="{{ $item->tanggal->format('Y-m-d') }}" required>
                        </div>

                        <!-- Jilid -->
                        <div class="col-md-4">
                            <label for="edit_jilid{{ $item->id }}" class="form-label">
                                Jilid <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" id="edit_jilid{{ $item->id }}" name="jilid" required>
                                <option value="">Pilih Jilid</option>
                                <option value="Iqra 1" {{ $item->jilid == 'Iqra 1' ? 'selected' : '' }}>Iqra 1</option>
                                <option value="Iqra 2" {{ $item->jilid == 'Iqra 2' ? 'selected' : '' }}>Iqra 2</option>
                                <option value="Iqra 3" {{ $item->jilid == 'Iqra 3' ? 'selected' : '' }}>Iqra 3</option>
                                <option value="Iqra 4" {{ $item->jilid == 'Iqra 4' ? 'selected' : '' }}>Iqra 4</option>
                                <option value="Iqra 5" {{ $item->jilid == 'Iqra 5' ? 'selected' : '' }}>Iqra 5</option>
                                <option value="Iqra 6" {{ $item->jilid == 'Iqra 6' ? 'selected' : '' }}>Iqra 6</option>
                                <option value="Al-Quran" {{ $item->jilid == 'Al-Quran' ? 'selected' : '' }}>Al-Quran
                                </option>
                            </select>
                        </div>

                        <!-- Halaman -->
                        <div class="col-md-4">
                            <label for="edit_halaman{{ $item->id }}" class="form-label">Halaman</label>
                            <input type="text" class="form-control" id="edit_halaman{{ $item->id }}"
                                name="halaman" value="{{ $item->halaman }}" placeholder="Contoh: 15">
                        </div>

                        <!-- Surah -->
                        <div class="col-md-6">
                            <label for="edit_surah{{ $item->id }}" class="form-label">Surah</label>
                            <input type="text" class="form-control" id="edit_surah{{ $item->id }}"
                                name="surah" value="{{ $item->surah }}" placeholder="Contoh: Al-Fatihah">
                        </div>

                        <!-- Ayat -->
                        <div class="col-md-6">
                            <label for="edit_ayat{{ $item->id }}" class="form-label">Ayat</label>
                            <input type="text" class="form-control" id="edit_ayat{{ $item->id }}" name="ayat"
                                value="{{ $item->ayat }}" placeholder="Contoh: 1-7">
                        </div>

                        <!-- Nilai -->
                        <div class="col-md-6">
                            <label for="edit_nilai{{ $item->id }}" class="form-label">Nilai</label>
                            <select class="form-select" id="edit_nilai{{ $item->id }}" name="nilai">
                                <option value="">Pilih Nilai</option>
                                <option value="A" {{ $item->nilai == 'A' ? 'selected' : '' }}>A - Sangat Baik
                                </option>
                                <option value="B" {{ $item->nilai == 'B' ? 'selected' : '' }}>B - Baik</option>
                                <option value="C" {{ $item->nilai == 'C' ? 'selected' : '' }}>C - Cukup</option>
                                <option value="D" {{ $item->nilai == 'D' ? 'selected' : '' }}>D - Kurang</option>
                                <option value="E" {{ $item->nilai == 'E' ? 'selected' : '' }}>E - Sangat Kurang
                                </option>
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <label for="edit_status{{ $item->id }}" class="form-label">
                                Status <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" id="edit_status{{ $item->id }}" name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="lancar" {{ $item->status == 'lancar' ? 'selected' : '' }}>Lancar
                                </option>
                                <option value="kurang_lancar"
                                    {{ $item->status == 'kurang_lancar' ? 'selected' : '' }}>Kurang Lancar</option>
                                <option value="mengulang" {{ $item->status == 'mengulang' ? 'selected' : '' }}>
                                    Mengulang</option>
                            </select>
                        </div>

                        <!-- Hafalan Checkbox -->
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="edit_hafalan{{ $item->id }}"
                                    name="hafalan" value="1" {{ $item->hafalan ? 'checked' : '' }}
                                    onchange="toggleHafalanFields{{ $item->id }}(this)">
                                <label class="form-check-label" for="edit_hafalan{{ $item->id }}">
                                    <i class="bi bi-star-fill text-warning"></i> Ada Hafalan
                                </label>
                            </div>
                        </div>

                        <!-- Hafalan Fields -->
                        <div id="hafalanFieldsEdit{{ $item->id }}"
                            style="display: {{ $item->hafalan ? 'block' : 'none' }};">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="edit_hafalan_surah{{ $item->id }}" class="form-label">
                                        Surah Hafalan
                                    </label>
                                    <input type="text" class="form-control"
                                        id="edit_hafalan_surah{{ $item->id }}" name="hafalan_surah"
                                        value="{{ $item->hafalan_surah }}" placeholder="Contoh: Al-Ikhlas">
                                </div>
                                <div class="col-md-3">
                                    <label for="edit_hafalan_ayat_dari{{ $item->id }}" class="form-label">Ayat
                                        Dari</label>
                                    <input type="number" class="form-control"
                                        id="edit_hafalan_ayat_dari{{ $item->id }}" name="hafalan_ayat_dari"
                                        value="{{ $item->hafalan_ayat_dari }}" min="1" placeholder="1">
                                </div>
                                <div class="col-md-3">
                                    <label for="edit_hafalan_ayat_sampai{{ $item->id }}" class="form-label">Ayat
                                        Sampai</label>
                                    <input type="number" class="form-control"
                                        id="edit_hafalan_ayat_sampai{{ $item->id }}" name="hafalan_ayat_sampai"
                                        value="{{ $item->hafalan_ayat_sampai }}" min="1" placeholder="4">
                                </div>
                            </div>
                        </div>

                        <!-- Catatan -->
                        <div class="col-12">
                            <label for="edit_catatan{{ $item->id }}" class="form-label">Catatan</label>
                            <textarea class="form-control" id="edit_catatan{{ $item->id }}" name="catatan" rows="3"
                                placeholder="Catatan tambahan tentang progress santri...">{{ $item->catatan }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-save me-1"></i>Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleHafalanFields{{ $item->id }}(checkbox) {
        const hafalanFields = document.getElementById('hafalanFieldsEdit{{ $item->id }}');
        hafalanFields.style.display = checkbox.checked ? 'block' : 'none';
    }
</script>
