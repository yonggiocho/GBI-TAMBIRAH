@extends('backend.layouts.app')


@section('content-backend')

  @if(auth()->user()->isAdmin())
  <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item active">Beranda</li>
                                            <li class="breadcrumb-item active">Edit Identitas</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Edit Identitas</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">

                                    <div class="card-body">


                                      <form method="POST" action="{{route('backend.identitas.update')}}" enctype="multipart/form-data">

                                        @csrf

                                      <div class="row">
                                          <div class="col-md-12">
                                            <h3>Identitas Umum</h3>
                                                <div class="mb-3">
                                                    <label for="nama_website" class="form-label">Nama Website</label>
                                                    <input type="text" id="nama_website" name="nama_website" class="form-control" placeholder="Masukkan nama website" value="{{ old('nama_website', $identitas->nama_website??'')}}">
                                                      @error('nama_website')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                </div>
                                          </div>

                                          <div class="col-md-6">
                                                <div class="mb-3 overflow-hidden">
                                                    <label for="logo" class="form-label">Logo Website</label>
                                                      <input type="file" id="logo" name="logo" class="form-control" onchange="previewLogo()">
                                                      @error('logo')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                      <p class="mt-2">Preview:</p>
                                                      @if(!empty($identitas) && !empty($identitas->logo))
                                                          <img class="logo-preview img-fluid mb-3 col-sm-5" src="{{asset('storage/'.$identitas->logo)}}" style="width: 250px; display:block;">
                                                      @else
                                                          <img class="logo-preview img-fluid mb-3 col-sm-5">
                                                      @endif
                                                </div>

                                          </div>
                                          <div class="col-md-6">
                                                <div class="mb-3 overflow-hidden">
                                                    <label for="favicon" class="form-label">Favicon</label>
                                                    <input type="file" id="favicon" name="favicon" class="form-control" onchange="previewFavicon()">
                                                      @error('favicon')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                      <p class="mt-2">Preview:</p>
                                                      @if(!empty($identitas) && !empty($identitas->favicon))
                                                        <img class="favicon-preview img-fluid mb-3 col-sm-5" src="{{asset('storage/'.$identitas->favicon)}}" style="width: 100px; display:block;">
                                                      @else
                                                        <img class="favicon-preview mb-3 col-sm-5" >
                                                      @endif
                                                </div>
                                          </div>
                                          <div class="col-md-6">
                                             <h3>Kontak</h3>

                                                <div class="mb-3">
                                                    <label for="telepon" class="form-label">Telepon</label>
                                                    <input type="text" id="telepon" name="telepon" class="form-control" placeholder="Masukkan nomor telepon" value="{{ old('telepon', $identitas->telepon??'')}}">
                                                      @error('telepon')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email" value="{{ old('email', $identitas->email??'')}}">
                                                      @error('email')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="alamat" class="form-label">Alamat</label>
                                                    <textarea name="alamat" class="form-control">{{ old('alamat', $identitas->alamat??'') }}</textarea>
                                                      @error('alamat')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                </div>
                                          </div>
                                           <!-- end col-->
                                          <div class="col-md-6">
                                             <h3>Sosial Media</h3>
                                                <div class="mb-3">
                                                    <label for="facebook" class="form-label">Facebook</label>
                                                    <input type="text" id="facebook" name="facebook" class="form-control" placeholder="Masukkan tautan facebook" value="{{ old('facebook', $identitas->facebook??'')}}">
                                                      @error('facebook')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="instagram" class="form-label">Instagram</label>
                                                    <input type="text" id="instagram" name="instagram" class="form-control" placeholder="Masukkan tautan instagram" value="{{ old('instagram', $identitas->instagram??'')}}">
                                                      @error('instagram')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="youtube" class="form-label">Nama Website</label>
                                                    <input type="text" id="youtube" name="youtube" class="form-control" placeholder="Masukkan tautan youtube" value="{{ old('youtube', $identitas->youtube??'')}}">
                                                      @error('youtube')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                </div>
                                          </div>
                                         <!-- end col-->
                                          <div class="col-md-6">
                                             <h3>Peta Lokasi</h3>


                                                <div class="mb-3">

                                                    <textarea name="map" rows="6" class="form-control">{{ old('map', $identitas->map??'') }}</textarea>
                                                      @error('map')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
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

                         <script>

                          function previewLogo(){
                            const gambar = document.querySelector('#logo');
                            const gambarPreview = document.querySelector('.logo-preview');

                            gambarPreview.style.display = 'block';
                            gambarPreview.style.height = '150px';
                            gambarPreview.style.width = '100%';


                            const oFReader = new FileReader();
                            oFReader.readAsDataURL(gambar.files[0]);

                            oFReader.onload = function(oFREvent){
                              gambarPreview.src = oFREvent.target.result;
                            }
                          }

                          function previewFavicon(){
                            const gambar = document.querySelector('#favicon');
                            const gambarPreview = document.querySelector('.favicon-preview');

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
  @endif


@endsection