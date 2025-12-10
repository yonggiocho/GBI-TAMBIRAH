@extends('backend.layouts.app')



@push('script')


  <script>
    $(document).ready(function () {
            $('#keluarga-datatable').DataTable();
    });



  </script>

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
                                            <li class="breadcrumb-item active">Beranda</li>
                                            <li class="breadcrumb-item active">Renungan</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Renungan</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-sm-4">
                                                <a href="{{route('backend.keluarga.create')}}" class="btn btn-success mb-2"><i class="mdi mdi-plus-circle me-2"></i>Tambah Data</a>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="text-sm-end">
                                                    <form action="{{route('backend.keluarga.export-pdf')}}" method="POST" target="_blank">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger mb-2 me-1"><i class="mdi mdi-file-pdf"></i> Export</button>
                                                    </form>
                                                </div>
                                            </div><!-- end col-->
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-centered w-100 dt-responsive nowrap" id="keluarga-datatable">
                                                <thead class="table-light">
                                                    <tr>

                                                        <th>No.</th>
                                                        <th>Nama Keluarga</th>
                                                        <th>Anggota Keluarga</th>
                                                        <th>Status Hubungan</th>
                                                        <th style="width: 85px;">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                  @foreach($keluargas as $keluarga)
                                                    <tr>
                                                      <td>{{$loop->iteration}}</td>
                                                      <td>{{$keluarga->kepala_keluarga}}</td>

                                                      <td>
                                                            {{'1. '.$keluarga->jemaatKeluarga->nama}}<br>
                                                        @if($keluarga->anggota->isNotEmpty())

                                                                    @foreach($keluarga->anggota as $anggota)

                                                                            {{$loop->iteration+1}}. {{$anggota->jemaat->nama ?? '-' }}<br>

                                                                    @endforeach

                                                            @else
                                                                <em>Tidak ada anggota</em>
                                                            @endif
                                                      </td>
                                                      <td>
                                                        {{'Kepala Keluarga'}}<br>
                                                        @if($keluarga->anggota->isNotEmpty())
                                                                @foreach($keluarga->anggota as $anggota)
                                                                         {{$anggota->hubungan }}<br>
                                                                @endforeach
                                                            @else
                                                                <em>Tidak ada anggota</em>
                                                            @endif
                                                      </td>

                                                      <td class="table-action">

                                                        <form method="POST" action="{{route('backend.keluarga.edit', $keluarga->id)}}" style="display:inline-block;">
                                                            @csrf
                                                            <button  class="btn btn-outline-warning btn-sm"><i class="mdi mdi-square-edit-outline"></i> Edit</button>
                                                        </form>

                                                        <form id="formHapus" action="{{route('backend.keluarga.delete', $keluarga->id)}}" method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button id="btn-hapus-keluarga" class="btn btn-outline-danger btn-sm" type="submit">
                                                                <i class="mdi mdi-delete-outline"></i>Hapus
                                                            </button>
                                                        </form>
                                                      </td>
                                                    </tr>
                                                    @endforeach


                                                </tbody>
                                            </table>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->



      </div> <!-- container -->



@endsection

@push('alerts')
    <script>

        document.addEventListener('DOMContentLoaded', function () {
        const tombolHapus = document.querySelectorAll('#btn-hapus-keluarga');

        tombolHapus.forEach(function (btn) {
          btn.addEventListener('click', function (e) {
            e.preventDefault(); // Mencegah form langsung submit
            const form = this.closest('form'); // Ambil form terdekat

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

@endpush

