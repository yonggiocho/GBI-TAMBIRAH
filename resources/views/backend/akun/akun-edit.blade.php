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
                                            <li class="breadcrumb-item active">Edit Akun</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Edit Akun</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-8">
                                <div class="card">
                                    <div class="card-body">


                                      <form method="POST" action="{{route('backend.akun.update', $akun->id)}}" >
                                        @method('PUT')
                                        @csrf

                                        <div class="row">
                                          <div class="col-xl-12">

                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Nama</label>
                                                    <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan Nama" value="{{ old('name', $akun->name)}}">
                                                      @error('name')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                </div>


                                                 <div class="mb-3">
                                                    <label for="password" class="form-label">Password Baru</label>
                                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password Baru" >
                                                      @error('password')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="pass_konfirm" class="form-label">Konfirmasi Password</label>
                                                    <input type="password" id="pass_konfirm" name="pass_konfirm" class="form-control" placeholder="Konfirmasi Password">
                                                      @error('pass_konfirm')
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
                                              <button class="btn btn-primary" type="submit"><i class="uil-file-edit-alt"></i> Simpan</button>
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