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
                                            <li class="breadcrumb-item active">Tambah Data Jemaat</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Tambah Data Jemaat</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">


                                      <form method="POST" action="{{route('backend.jemaat.store')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                          <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama</label>
                                                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama . . ." value="{{ old('nama')}}">
                                                      @error('nama')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                                    <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Masukkan tempat lahir . . ." value="{{ old('tempat_lahir')}}">
                                                      @error('tempat_lahir')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control"  value="{{ old('tanggal_lahir')}}">
                                                      @error('tanggal_lahir')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email . . ." value="{{ old('email')}}">
                                                      @error('email')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="no_hp" class="form-label">No. Handphone</label>
                                                    <input type="number" id="no_hp" name="no_hp" class="form-control" placeholder="Masukkan nomor handphone" value="{{ old('no_hp')}}">
                                                      @error('no_hp')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="alamat" class="form-label">Alamat</label>
                                                    <textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror">{{old('alamat')}}</textarea>
                                                    @error('alamat')
                                                            <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>


                                          </div> <!-- end col-->

                                          <div class="col-xl-6">
                                               <div class="mb-4">
                                                    <label class="form-label">Jenis Kelamin</label><br>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Laki-laki"
                                                              {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="jenis_kelamin">Laki-laki</label>
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Perempuan"
                                                              {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="jenis_kelamin">Perempuan</label>
                                                    </div>
                                                    @error('jenis_kelamin')
                                                            <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="mb-4">
                                                    <label class="form-label">Status Baptis</label><br>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="status_baptis" id="status_baptis" value="Sudah"
                                                              {{ old('status_baptis') == 'Sudah' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="status_baptis"><span class="badge bg-success">Sudah<span></label>

                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="status_baptis" id="status_baptis" value="Belum"
                                                              {{ old('status_baptis') == 'Belum' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="status_baptis"><span class="badge bg-danger">Belum<span></label>
                                                    </div>
                                                    @error('status_baptis')
                                                            <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="keterangan" class="form-label">Keterangan</label>
                                                    <textarea id="keterangan" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{old('keterangan')}}</textarea>
                                                    @error('keterangan')
                                                            <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>


                                          </div>


                                        </div>

                                        <!-- end row -->
                                        <div class="row">
                                          <div class="col-xl-6">
                                              <button class="btn btn-success" type="submit"><i class="uil-file-edit-alt"></i> Simpan</button>
                                          </div>
                                        </div>
                                      </form>

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->


      </div> <!-- container -->
@endsection