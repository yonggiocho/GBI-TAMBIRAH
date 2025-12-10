@extends('backend.layouts.app')

@push('script')

  <script>
    $(document).ready(function () {
            $('#akun-datatable').DataTable();
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
                                            <li class="breadcrumb-item active">Daftar Akun</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Akun</h4>
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
                                                <a href="{{route('backend.akun.create')}}" class="btn btn-success mb-2"><i class="mdi mdi-plus-circle me-2"></i>Tambah Data</a>
                                            </div>

                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-centered w-100 dt-responsive nowrap" id="akun-datatable">
                                                <thead class="table-light">
                                                    <tr>

                                                        <th>No.</th>
                                                        <th>Nama</th>
                                                        <th>Email</th>
                                                        <th>Role</th>
                                                        <th style="width: 85px;">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                  @foreach ($akuns as $akun)
                                                  @php
                                                        [$nama, $domain] = explode('@', $akun->email);
                                                        $maskedEmail = substr($nama, 0, 1) . str_repeat('*', strlen($nama) - 1) . '@' . $domain;
                                                   @endphp

                                                  @if(auth()->user()->isAdmin())
                                                    <tr>
                                                      <td>{{$loop->iteration}}</td>
                                                      <td>{{$akun->name}}</td>
                                                        <td>{{$maskedEmail}}</td>
                                                        <td>{{$akun->role == 'admin' ? 'Administrator' : 'Staf'}}</td>

                                                      <td class="table-action">
                                                        @if($akun->name === auth()->user()->name OR $akun->role === 'staf')
                                                        <form method="POST" action="{{route('backend.akun.edit',$akun->id)}}" style="display:inline-block;">
                                                            @csrf
                                                            <button  class="btn btn-outline-warning"><i class="mdi mdi-square-edit-outline"></i> Edit</button>
                                                        </form>
                                                        @endif

                                                        @if($akun->role === 'staf')
                                                        <form id="formHapus" action="{{route('backend.akun.delete', $akun->id)}}" method="POST" style="display: inline-block;">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button id="hapus-akun" class="btn btn-outline-danger" type="submit">
                                                                <i class="mdi mdi-delete-outline"></i>Hapus
                                                            </button>
                                                        </form>
                                                        @endif

                                                      </td>
                                                    </tr>
                                                    @elseif($akun->name === auth()->user()->name)
                                                      <tr>
                                                      <td>1</td>
                                                      <td>{{$akun->name}}</td>
                                                        <td>{{$maskedEmail}}</td>
                                                        <td>{{$akun->role == 'admin' ? 'Administrator' : 'Staf'}}</td>

                                                      <td class="table-action">
                                                        <form method="POST" action="{{route('backend.akun.edit',$akun->id)}}" style="display:inline-block;">
                                                            @csrf
                                                            <button  class="btn btn-outline-warning"><i class="mdi mdi-square-edit-outline"></i> Edit</button>
                                                        </form>

                                                        <form id="formHapus" action="{{route('backend.akun.delete', $akun->id)}}" method="POST" style="display: inline-block;">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button id="hapus-akun" class="btn btn-outline-danger" type="submit">
                                                                <i class="mdi mdi-delete-outline"></i>Hapus
                                                            </button>
                                                        </form>
                                                      </td>
                                                    </tr>
                                                    @endif


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
        const tombolHapus = document.querySelectorAll('#hapus-akun');

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

@endpush

