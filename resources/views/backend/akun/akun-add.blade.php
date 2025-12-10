@extends('backend.layouts.app')

@section('content-backend')

  <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-2title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item active">Beranda</li>
                                            <li class="breadcrumb-item active">Tambah Akun</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Akun</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-8">
                                <div class="card">
                                    <div class="card-body">


                                      <form method="POST" action="{{route('backend.akun.store')}}" >
                                        @csrf
                                        <div class="row">
                                          <div class="col-xl-12">


                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Nama</label>
                                                    <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan Nama" value="{{ old('name')}}">
                                                      @error('name')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan Email" value="{{ old('email')}}">
                                                      @error('name')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                </div>


                                                 <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
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