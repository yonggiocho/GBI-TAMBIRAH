@extends('backend.layouts.app')

@push('script')

  <script>
    $(document).ready(function () {
            $('#visimisi-datatable').DataTable();
    });
  </script>


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
                                            <li class="breadcrumb-item active">Visi-Misi</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Visi-Misi</h4>
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
                                                @empty($visimisi)
                                                 <a href="{{route('backend.visi-misi.create')}}" class="btn btn-success mb-2"><i class="mdi mdi-plus-circle me-2"></i>Tambah Data</a>
                                                @endempty
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="text-sm-end">

                                                </div>
                                            </div><!-- end col-->
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-centered w-100 dt-responsive nowrap" id="visimisi-datatable">
                                                <thead class="table-light">
                                                    <tr >
                                                        <th>Visi</th>
                                                        <th>Misi</th>
                                                        @if(auth()->user()->isAdmin())
                                                        <th style="width: 85px;">Aksi</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @empty(!$visimisi)
                                                    <tr>

                                                      <td style="white-space: normal; word-wrap: break-word; max-width:200px">{{substr(strip_tags($visimisi->teks_visi),0,300)}}</td>
                                                      <td style="white-space: normal; word-wrap: break-word; max-width:200px">{{substr(strip_tags($visimisi->teks_misi),0,300)}}</td>

                                                      @if(auth()->user()->isAdmin())
                                                      <td class="table-action">
                                                        <form method="POST" action="{{route('backend.visi-misi.edit', $visimisi->id)}}" style="display:inline-block;">
                                                            @csrf
                                                            <button class="btn btn-outline-warning"><i class="mdi mdi-square-edit-outline"></i> Edit</button>
                                                        </form>
                                                      </td>
                                                      @endif
                                                    </tr>
                                                    @endempty



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
