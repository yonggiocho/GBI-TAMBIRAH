@extends('backend.layouts.app')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet">
<style>
    .select2-container--bootstrap-5 .select2-selection {
        border-color: #ced4da !important;
        padding: 0.5rem 0.75rem !important;
        min-height: 45px !important;
        box-shadow: none !important;
        transition: box-shadow 0.2s ease;
    }
    .select2-container--bootstrap-5 .select2-selection:focus {
        border-color: #86b7fe !important;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, .25) !important;
    }
    .select2-dropdown {
        border-radius: 0.75rem !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
    }
</style>
@endpush


@section('content-backend')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Beranda</li>
                        <li class="breadcrumb-item active">Edit Data KK</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Data KK</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <form method="POST" action="{{ route('backend.keluarga.update', $keluarga->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="kepala_keluarga" class="form-label">Nama Keluarga</label>
                                    <input type="text" id="kepala_keluarga" name="kepala_keluarga"
                                        class="form-control"
                                        value="{{ old('kepala_keluarga', $keluarga->kepala_keluarga) }}"
                                        placeholder="Masukkan nama keluarga">
                                    @error('kepala_keluarga')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nameSelect" class="form-label">Kepala Keluarga</label>
                                    <select class="form-select select2" name="jemaat_id" id="nameSelect">
                                        <option value="" hidden>--Pilih--</option>
                                        @foreach($jemaats as $jemaat)
                                            <option value="{{ $jemaat->id }}"
                                                {{ $jemaat->id == $keluarga->jemaat_id ? 'selected' : '' }}>
                                                {{ $jemaat->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <h4>Anggota Keluarga</h4>
                                <div id="anggota-wrapper">
                                    @foreach($keluarga->anggota as $i => $anggota)
                                        <div class="card p-3 mt-2 anggota-item">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6>Anggota #{{ $i + 1 }}</h6>
                                                <button type="button" class="btn btn-sm btn-danger hapus-anggota">Hapus</button>
                                            </div>
                                            <div class="mt-2">
                                                <label>Nama Jemaat</label>
                                                <select name="anggota[{{ $i }}][jemaat_id]" class="form-select select2" required>
                                                    <option value="" hidden>--Pilih jemaat--</option>
                                                    @foreach($jemaats as $jemaat)
                                                        <option value="{{ $jemaat->id }}"
                                                            {{ $jemaat->id == $anggota->jemaat_id ? 'selected' : '' }}>
                                                            {{ $jemaat->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mt-2">
                                                <label>Hubungan</label>
                                                <input type="text"
                                                    name="anggota[{{ $i }}][hubungan]"
                                                    class="form-control"
                                                    value="{{ $anggota->hubungan }}"
                                                    placeholder="Suami / Istri / Anak" required>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" id="tambah-anggota" class="btn btn-outline-primary btn-sm mt-2">
                                    + Tambah Anggota
                                </button>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-xl-6">
                                <button class="btn btn-success" type="submit">
                                    <i class="uil-save"></i> Update
                                </button>
                                <a href="{{ route('backend.keluarga') }}" class="btn btn-secondary">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    let index = {{ $keluarga->anggota->count() }};

    function aktifkanSelect2(context) {
        $(context).find('.select2').select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: "--Pilih jemaat--",
            allowClear: true
        });
    }

    aktifkanSelect2(document);

    $('#tambah-anggota').on('click', function() {
        let html = `
        <div class="card p-3 mt-2 anggota-item">
            <div class="d-flex justify-content-between align-items-center">
                <h6>Anggota #${index + 1}</h6>
                <button type="button" class="btn btn-sm btn-danger hapus-anggota">Hapus</button>
            </div>
            <div class="mt-2">
                <label>Nama Jemaat</label>
                <select name="anggota[${index}][jemaat_id]" class="form-select select2" required>
                    <option value="" hidden>--Pilih jemaat--</option>
                    @foreach($jemaats as $jemaat)
                        <option value="{{ $jemaat->id }}">{{ $jemaat->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-2">
                <label>Hubungan</label>
                <input type="text" name="anggota[${index}][hubungan]" class="form-control" placeholder="Istri / Anak / Lainnya" required>
            </div>
        </div>`;

        const elemenBaru = $(html).appendTo('#anggota-wrapper');
        aktifkanSelect2(elemenBaru);
        index++;
    });

    $(document).on('click', '.hapus-anggota', function() {
        $(this).closest('.anggota-item').remove();
    });
});
</script>
@endpush
