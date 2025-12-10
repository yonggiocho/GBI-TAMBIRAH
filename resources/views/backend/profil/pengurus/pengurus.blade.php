@extends('backend.layouts.app')

@push('script')

  <script>
    $(document).ready(function () {
            $('#pengurus-datatable').DataTable();
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
                                            <li class="breadcrumb-item active">Profil Gereja</li>
                                            <li class="breadcrumb-item active">Pengurus</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Pengurus</h4>
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
                                                @if(auth()->user()->isAdmin())
                                                    <a href="{{route('backend.pengurus.create')}}" class="btn btn-success mb-2"><i class="mdi mdi-plus-circle me-2"></i>Tambah Data</a>
                                                @endif
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="text-sm-end">
                                                    {{-- <button type="button" class="btn btn-success mb-2 me-1"><i class="mdi mdi-cog-outline"></i></button> --}}
                                                    {{-- <button type="button" class="btn btn-light mb-2 me-1">Import</button> --}}
                                                    {{-- <button type="button" class="btn btn-light mb-2">Export</button> --}}
                                                </div>
                                            </div><!-- end col-->
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-centered w-100 dt-responsive nowrap" id="pengurus-datatable">
                                                <thead class="table-light">
                                                    <tr>

                                                        <th>No.</th>
                                                        <th>Nama</th>
                                                        <th>Gelar Depan</th>
                                                        <th>Gelar Belakang</th>
                                                        <th>Jabatan</th>
                                                        <th>Gambar</th>
                                                       @if(auth()->user()->isAdmin()) <th style="width: 85px;">Aksi</th>@endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                  @foreach ($pengurus as $p)
                                                    <tr>
                                                      <td>{{$loop->iteration}}</td>
                                                      <td>{{$p->nama}}</td>
                                                      <td>{{$p->gelar_depan}}</td>
                                                      <td>{{$p->gelar_belakang}}</td>
                                                      <td>{{$p->jabatan}}</td>
                                                      <td class="text-center"><img src="{{ asset('storage/'.$p->gambar)}}"
                                                          alt="{{ $p->gambar }}"
                                                          width="50"
                                                          height="50"
                                                          class="object-fit-cover">
                                                      </td>
                                                      @if(auth()->user()->isAdmin())
                                                        <td class="table-action">
                                                            <form method="POST" action="{{route('backend.pengurus.edit', $p->id)}}" style="display:inline-block;">
                                                                @csrf
                                                                <button class="btn btn-outline-warning"><i class="mdi mdi-square-edit-outline"></i> Edit</button>
                                                            </form>

                                                            <form id="formHapus" action="{{ route('backend.pengurus.delete', $p->id) }}" method="POST" style="display: inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button id="btn-hapus-pengurus" class="btn btn-outline-danger" type="submit">
                                                                    <i class="mdi mdi-delete-outline"></i>Hapus
                                                                </button>
                                                            </form>
                                                        </td>
                                                      @endif
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
        const tombolHapus = document.querySelectorAll('#btn-hapus-pengurus');

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

