@extends('backend.layouts.app')

@section('content-backend')

  <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item active">Beranda</li>
                                            <li class="breadcrumb-item active">Profil Jemaat</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Profil Jemaat</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">



                                        <div class="row">
                                          <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama:</label>
                                                    <input type="text" id="nama"class="form-control" value="{{ $jemaat->nama}}" disabled>

                                                </div>

                                                <div class="mb-3">
                                                    <label for="tempat_lahir" class="form-label">Tempat Lahir:</label>
                                                    <input type="text" id="tempat_lahir"  class="form-control" value="{{ $jemaat->tempat_lahir}}" disabled>

                                                </div>

                                                <div class="mb-3">
                                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir:</label>
                                                    <input type="text" id="tanggal_lahir"  class="form-control"  value="{{ \Carbon\Carbon::parse($jemaat->tanggal_lahir)->format('j F Y')}}" disabled>

                                                </div>

                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email:</label>
                                                    <input type="text" id="email" class="form-control"  value="{{ $jemaat->email}}" disabled>

                                                </div>

                                                <div class="mb-3">
                                                    <label for="no_hp" class="form-label">No. Handphone:</label>
                                                    <input type="text" id="no_hp" name="no_hp" class="form-control" value="{{ $jemaat->no_hp }}" disabled>

                                                </div>

                                                <div class="mb-3">
                                                    <label for="alamat" class="form-label">Alamat:</label>
                                                    <textarea id="alamat" name="alamat" class="form-control" disabled>{{$jemaat->alamat}}</textarea>

                                                </div>


                                          </div> <!-- end col-->

                                          <div class="col-xl-6">
                                               <div class="mb-3">
                                                    <label class="form-label">Jenis Kelamin:</label><br>
                                                    <p>{{$jemaat->jenis_kelamin}}</p>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Status Baptis:</label><br>
                                                    <h4 class="badge bg-{{$jemaat->status_baptis === 'Sudah' ? 'success':'danger'}}">{{$jemaat->status_baptis }} </h4>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="keterangan" class="form-label">Keterangan:</label>
                                                    <textarea id="keterangan" name="keterangan" class="form-control" disabled>{{ $jemaat->keterangan }}</textarea>

                                                </div>


                                          </div>

                                        </div>

                                        <!-- end row -->
                                        <div class="row">
                                          <div class="col-xl-6">
                                              <a href="{{route('backend.jemaat')}}" class="btn btn-primary" type="submit"><i class="uil-file-edit-alt"></i> Kembali</a>
                                          </div>
                                        </div>


                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->


      </div> <!-- container -->
@endsection