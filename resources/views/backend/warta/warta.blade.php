@extends('backend.layouts.app')

@push('script')

  <script>
    $(document).ready(function () {
            $('#warta-datatable').DataTable();
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
                                            <li class="breadcrumb-item active">Warta</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Warta</h4>
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
                                                <a href="{{route('backend.warta.create')}}" class="btn btn-success mb-2"><i class="mdi mdi-plus-circle me-2"></i>Tambah Data</a>
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
                                            <table class="table table-centered w-100 dt-responsive nowrap" id="warta-datatable">
                                                <thead class="table-light">
                                                    <tr>

                                                        <th>No.</th>
                                                        <th>Judul</th>
                                                        <th>Isi</th>
                                                        <th>Status</th>
                                                        <th>Gambar</th>
                                                        <th style="width: 85px;">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                  @foreach ($wartas as $warta)
                                                    <tr>
                                                      <td>{{$loop->iteration}}</td>
                                                      <td style="white-space: normal; word-wrap: break-word; max-width:150px">{{substr($warta->judul, 0, 80).'...'}}</td>
                                                      <td style="white-space: normal; word-wrap: break-word; max-width:200px">{{substr(strip_tags($warta->isi), 0, 100).'...'}}</td>
                                                      <td>
                                                            @php
                                                                $status = $warta->status == 'draft' ? 'publish':'draft';
                                                            @endphp

                                                            <form method="POST" action="{{route('backend.warta.edit-status',[$warta->id,$status])}}" style="display:inline-block;">
                                                                @csrf
                                                                @method('PUT')
                                                                <button class="btn btn-outline-{{$warta->status == 'publish' ?'success':'warning'}} btn-sm">{{$warta->status}}</button>
                                                            </form>
                                                     </td>
                                                      <td class="text-center"><img src="{{ asset('storage/'.$warta->gambar)}}"
                                                          alt="gambar"
                                                          width="100"
                                                          height="80"
                                                          class="object-fit-cover">
                                                      </td>
                                                      <td class="table-action">
                                                        <form method="POST" action="{{route('backend.warta.edit',$warta->id)}}" style="display:inline-block;">
                                                            @csrf
                                                            <button  class="btn btn-outline-primary btn-sm"><i class="mdi mdi-square-edit-outline"></i> Edit</button>
                                                        </form>

                                                        @if(auth()->user()->isAdmin())
                                                        <form id="formHapus" action="{{route('backend.warta.delete', $warta->id)}}" method="POST" style="display: inline-block;">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button id="hapus-warta" class="btn btn-outline-danger btn-sm" type="submit">
                                                                <i class="mdi mdi-delete-outline"></i>Hapus
                                                            </button>
                                                        </form>
                                                        @endif

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
        const tombolHapus = document.querySelectorAll('#hapus-warta');

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

