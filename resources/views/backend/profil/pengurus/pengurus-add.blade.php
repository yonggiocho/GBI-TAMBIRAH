@extends('backend.layouts.app')


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
                                    <h4 class="page-title">Form  Pengurus</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">


                                      <form method="POST" action="{{route('backend.pengurus.store')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                          <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama</label>
                                                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama" value="{{ old('nama')}}">
                                                      @error('nama')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="gelar_depan" class="form-label">Gelar Depan</label>
                                                    <input type="text" name="gelar_depan" id="gelar_depan" class="form-control" placeholder="Gelar Depan" value="{{ old('gelar_depan')}}">
                                                      @error('gelar_depan')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="gelar_belakang" class="form-label">Gelar Belakang</label>
                                                    <input type="text" name="gelar_belakang" id="gelar_belakang" class="form-control" placeholder="Gelar Belakang" value="{{ old('gelar_belakang')}}">
                                                      @error('gelar_belakang')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                </div>



                                          </div> <!-- end col-->



                                          <div class="col-xl-6">
                                                 <div class="mb-3">
                                                    <label for="jabatan" class="form-label">Jabatan</label>
                                                    <input type="text" name="jabatan" id="jabatan" class="form-control" placeholder="Jabatan" value="{{ old('jabatan')}}">
                                                      @error('jabatan')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                </div>



                                                <div class="mb-3">
                                                    <label for="gambar" class="form-label">Gambar</label>
                                                    <img class="gambar-preview img-fluid mb-3 col-sm-5" >
                                                    <input type="file" id="gambar" name="gambar" class="form-control" onchange="previewGambar()">
                                                      @error('gambar')
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

                         <script>

                          function previewGambar(){
                            const gambar = document.querySelector('#gambar');
                            const gambarPreview = document.querySelector('.gambar-preview');

                            gambarPreview.style.display = 'block';
                            gambarPreview.style.height = '150px';
                            gambarPreview.style.width = '150px';

                            const oFReader = new FileReader();
                            oFReader.readAsDataURL(gambar.files[0]);

                            oFReader.onload = function(oFREvent){
                              gambarPreview.src = oFREvent.target.result;
                            }
                          }

                    </script>

                    </div> <!-- container -->



@endsection