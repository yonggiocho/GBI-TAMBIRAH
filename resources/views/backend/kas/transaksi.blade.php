@extends('backend.layouts.app')

@push('script')

<script src="{{asset('assets/backend/js/vendor/sweetalert2.all.min.js')}}"></script>

@endpush


@section('content-backend')
<div class="container-fluid">

    <div class="row mt-3">
        <div class="col-3">
            <div class="alert alert-warning" role="alert">

                        <div class="text-center">
                            <span><i class="uil-wallet" style="font-size: 30px"></i></span>
                            <h5>Saldo Awal:</h5>
                            <h4>Rp. {{ number_format($saldo_awal, 0, ',', '.') }} </h4>
                        </div>

            </div>
        </div>
        <div class="col-3">
            <div class="alert alert-success" role="alert">

                        <div class="text-center">
                            <span><i class="uil-arrow-down" style="font-size: 30px"></i></span>
                            <h5>Pemasukan:</h5>
                            <h4>Rp. {{ number_format($pemasukan, 0, ',', '.') }} </h4>
                        </div>

                </div> <!-- end card-->
        </div>
        <div class="col-3">
            <div class="alert alert-danger" role="alert">

                        <div class="text-center">
                            <span><i class="uil-arrow-up" style="font-size: 30px"></i></span>
                            <h5>Pengeluaran:</h5>
                            <h4>Rp. {{ number_format($pengeluaran, 0, ',', '.') }} </h4>
                        </div>

            </div> <!-- end card-->

        </div>
        <div class="col-3">
            <div class="alert alert-primary" role="alert">

                        <div class="text-center">
                            <span><i class="uil-wallet" style="font-size: 30px"></i></span>
                            <h5>Saldo Akhir:</h5>
                            <h4>Rp. {{ number_format($saldo, 0, ',', '.') }} </h4>
                        </div>

             </div> <!-- end card-->
        </div>

    </div>



    <div class="row ">
        <div class="col-12">
            <div class="card">
                 <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Form Transaksi: {{ $namaBulan[$bulan->bulan] }}</h4>
                    <a href="{{ route('kas.showBulan', $bulan->tahun_id) }}" class="btn btn-primary "><i class="uil-arrow-left"></i>Kembali</a>
                </div>
                <div class="card-body">
                @if($bulan->berjalan())
                    <form method="POST" action="{{ route('kas.storeTransaksi', [$bulan->tahun_id, $bulan->id]) }}">
                    @csrf
                    <div class="row">
                        <div class="col-xl-4">
                                <label for="tanggal" class="form-label">Tanggal:</label>
                                <input type="number" id="tanggal" name="tanggal" class="form-control"min="1" max="31" maxlength="2"
                                    oninput="if(this.value.length > 2) this.value = this.value.slice(0, 2);"
                                    class="form-control" placeholder="1" value="{{ old('tanggal')}}">
                                    @error('tanggal')
                                    <small class="form-text text-danger">
                                        {{$message}}
                                    </small>
                                     @enderror
                        </div>

                        <div class="col-xl-4">
                            <label for="tanggal" class="form-label">Bulan:</label>
                            <input type="text" class="form-control" value="{{$namaBulan[$bulan->bulan]}}" disabled>
                            <input type="hidden" name="bulan"  value="{{ $bulan->bulan }}">
                        </div>

                        <div class="col-xl-4 mb-2">
                            <label for="tahun" class="form-label">Tahun:</label>
                            <input type="text" class="form-control" value="{{ $bulan->kasTahun->tahun }}" disabled>
                            <input type="hidden" name="tahun" value="{{ $bulan->kasTahun->tahun }}">
                        </div>


                        <div class="col-xl-12">
                            <div class="mb-2">
                                <label for="keterangan" class="form-label">Keterangan:</label>
                                <input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Masukkan keterangan" value="{{ old('keterangan')}}">
                                    @error('keterangan')
                                    <small class="form-text text-danger">
                                        {{$message}}
                                    </small>
                                    @enderror
                            </div>

                            <div class="mb-2">
                                <label for="jenis" class="form-label">Kategori Transaksi:</label>
                                <select name="jenis" id="jenis" class="form-select">
                                    <option value="" hidden>Pilih Kategori</option>
                                    <option value="pemasukan" {{ old('jenis') == 'pemasukan' ? 'selected' : '' }}>Pemasukkan</option>
                                    <option value="pengeluaran" {{ old('jenis') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                                </select>
                                    @error('jenis')
                                    <small class="form-text text-danger">
                                        {{$message}}
                                    </small>
                                    @enderror
                            </div>

                            <div class="mb-2">
                                <label for="jumlah" class="form-label">Nominal:</label>
                                <input type="number" id="jumlah" name="jumlah" class="form-control" placeholder="0  " value="{{ old('jumlah')}}">
                                    @error('jumlah')
                                    <small class="form-text text-danger">
                                        {{$message}}
                                    </small>
                                    @enderror
                            </div>

                        </div> <!-- end col-->
                    </div>

                    <!-- end row -->
                    <div class="row">
                        <div class="col-xl-6">
                            <button class="btn btn-success" type="submit"><i class="uil-book-medical"></i> Tambah Transaksi</button>
                        </div>
                    </div>
                    </form>
                @endif
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col-->

    </div> <!-- end row-->


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-10">
                            <h4>Daftar Transaksi: {{ $namaBulan[$bulan->bulan] }}</h4>

                        </div>
                        <div class="col-lg-2">
                            <div class="text-sm-end">

                                        <form  action="{{route('backend.kas.export-pdf', $bulan->id)}}" method="POST" target="_blank">
                                            @csrf
                                            <button type="submit" class="btn btn-danger mb-2 me-1"><i class="mdi mdi-file-pdf"></i> Export</button>
                                        </form>

                            </div>
                        </div>
                    </div>


                </div>
                <div class="card-body">

                    <table class="table table-bordered table-centered mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Jumlah</th>
                                @if($bulan->berjalan())<th class="text-center">Aksi</th>@endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi as $t)
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($t->tanggal)->format('d-m-Y') }}</td>
                                        <td>{{ $t->keterangan }}</td>
                                        <td class="text-center text-{{$t->jenis == 'pemasukan' ? 'success' : 'danger'}}"><strong>{{ ucfirst($t->jenis) }}</strong></td>
                                        <td class="text-center">Rp. {{ number_format($t->jumlah, 0, ',', '.') }}</td>
                                    @if($bulan->berjalan())
                                        <td class="table-action text-center">
                                           <form id="formHapus" action="{{route('backend.kas.delete', $t->id)}}" method="POST" style="display: inline-block;">
                                                @method('DELETE')
                                                @csrf
                                                <button id="hapusTransaksi" class="btn btn-outline-danger" type="submit">
                                                    <i class="mdi mdi-delete-outline"></i>Hapus
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>

                    @if($bulan->berjalan())
                        <div class="alert alert-warning mt-2" role="alert">
                                    <h4 class="alert-heading">Perhatian!</h4>
                                    <p>Dengan mengklik tombol <strong> Selesai  </strong>maka tidak ada lagi pengisian transaksi selanjutnya.</p>
                                    <hr>
                                <form action="{{route('kas.status.update',[$bulan->id,'selesai'])}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button id="statusTransaksi"  class="btn btn-danger" type="submit"><i class="uil-check-circle"></i> Selesai </button>
                                </form>
                        </div>
                    @endif





                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('alerts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const tombolHapus = document.querySelectorAll('#hapusTransaksi');

        tombolHapus.forEach(function (btn) {
          btn.addEventListener('click', function (e) {
            e.preventDefault();
            const form = this.closest('form');

            Swal.fire({
              title: 'Hapus Data!',
              text : 'Apakah anda yakin ingin menghapus?',
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const tombolStatus = document.querySelectorAll('#statusTransaksi');

        tombolStatus.forEach(function (btn) {
          btn.addEventListener('click', function (e) {
            e.preventDefault();
            const form = this.closest('form');

            Swal.fire({
              title: 'Selesai!',
              text : 'Apakah anda yakin mengakhiri pengisian transaksi selanjutnya?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#3085d6',
              confirmButtonText: 'Selesai!',
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

