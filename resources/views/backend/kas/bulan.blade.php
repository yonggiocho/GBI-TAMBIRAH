@extends('backend.layouts.app')

@push('script')

<script src="{{asset('assets/backend/js/vendor/sweetalert2.all.min.js')}}"></script>

@endpush

@section('content-backend')
<div class="container-fluid">

     <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('backend.beranda')}}">Beranda</a></li>
                        <li class="breadcrumb-item active">Bulan</li>
                    </ol>
                </div>
                <h4 class="page-title">📆 Tahun: {{ $tahun->tahun }}</h4>
            </div>
        </div>
    </div>


    <div class="row mb-2">
        @if($bulan->isEmpty() || $bulan->where('status', 'berjalan')->isEmpty())
        <div class="col-sm-10">
            <button  type="button" class="btn btn-success btn-rounded mb-3" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm"> <i class="mdi mdi-plus"></i>Tambah Bulan</button>
        </div>

        <div class="modal fade" id="bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="mySmallModalLabel">Tambah Bulan</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{  route('kas.tambahBulan', $tahun->id) }}" method="POST" class="mb-3">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Bulan</label>
                                <select name="bulan" class="form-select">
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{old('bulan') == $i ? 'selected':''}}>{{ $namaBulan[$i] }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="mb-3 d-flex justify-content-end gap-1">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!--end modal -->
        <div class="col-6">
            @error('bulan')
            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{$message }}
            </div>
            @enderror
        </div>

        @endif

    </div>

    <div class="row">

         @foreach($bulan as $b)
            <div class="col-md-3">
                <div class="card ribbon-box border-primary border">
                    <div class="card-body">
                        <div class="ribbon ribbon-{{$b->status === 'selesai' ? 'success':'warning'}} float-end">{{$b->status === 'selesai' ? 'Selesai':'Masih berjalan'}}</div>
                        <h3 class="text-primary float-start mt-0">{{ $namaBulan[$b->bulan] }}</h3>
                        <div class="ribbon-content">
                            <p class="card-text">Klik lanjutkan untuk pengisian</p>
                            <a href="{{ route('kas.showTransaksi', [$tahun->id, $b->id]) }}" class="btn btn-outline-primary btn-sm"> <i class="mdi mdi-arrow-right-thick"></i> Lanjutkan</a>
                            <form id="formHapus" action="{{route('backend.kasBulan.delete', $b->id)}}" method="POST" style="display: inline-block;">
                                @method('DELETE')
                                @csrf
                                    <button id="hapusBulan" class="btn btn-outline-danger btn-sm" type="submit">
                                        <i class="mdi mdi-delete-outline"></i>Hapus
                                    </button>
                            </form>

                        </div>
                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div>
        @endforeach
    </div>

</div>
@endsection

@push('alerts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const tombolHapus = document.querySelectorAll('#hapusBulan');

        tombolHapus.forEach(function (btn) {
          btn.addEventListener('click', function (e) {
            e.preventDefault();
            const form = this.closest('form');

            Swal.fire({
              title: 'Hapus Bulan!',
              text : 'Apakah anda yakin ingin menghapus daftar bulan?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#3085d6',
              confirmButtonText: 'Ya, hapus!',
              cancelButtonText: 'Batal'
            }).then((result) => {
              if (result.isConfirmed) {
                form.submit(); // Submit form kalau dikonfirmasi
              }
            });
          });
        });
      });
    </script>

@endpush

