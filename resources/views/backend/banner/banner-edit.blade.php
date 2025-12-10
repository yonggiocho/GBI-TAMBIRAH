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
                                            <li class="breadcrumb-item active">Edit Banner</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Edit Banner</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">

                                    <div class="card-body">


                                      <form method="POST" action="{{route('backend.banner.update')}}" enctype="multipart/form-data">

                                        @csrf

                                      <div class="row">
                                          <div class="col-md-12">
                                            <h3>Banner</h3>
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Title :</label>
                                                    <input type="text" id="title" name="title" class="form-control" placeholder="Masukkan title" value="{{ old('title', $banner->title??'')}}">
                                                      @error('title')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                </div>
                                          </div>

                                          <div class="col-md-6">
                                                <div class="mb-3 overflow-hidden">
                                                    <label for="bg_front" class="form-label">Latar Belakang Depan : </label>
                                                      <input type="file" id="bg_front" name="bg_front" class="form-control" onchange="previewFront()">
                                                      @error('bg_front')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                      <p class="mt-2">Preview:</p>
                                                      @if(!empty($banner) && !empty($banner->bg_front))
                                                          <img class="front-preview img-fluid mb-2 col-sm-5" src="{{asset('storage/'.$banner->bg_front)}}" style="height: 200px; width: 70%; display:block;">
                                                      @else
                                                          <img class="front-preview img-fluid mb-2 col-sm-5">
                                                      @endif
                                                      <p class="text-primary mt-2">rekomendasi resolusi = (2850 x 1636) dan maxsize = 2 MB </p>
                                                </div>
                                          </div>

                                          <div class="col-md-6">
                                                <div class="mb-3 overflow-hidden">
                                                    <label for="bg_page" class="form-label">Latar Belakang Halaman :</label>
                                                    <input type="file" id="bg_page" name="bg_page" class="form-control" onchange="previewPage()">
                                                      @error('bg_page')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                      <p class="mt-2">Preview:</p>
                                                      @if(!empty($banner) && !empty($banner->bg_page))
                                                        <img class="page-preview img-fluid mb-2 col-sm-5" src="{{asset('storage/'.$banner->bg_page)}}" style="height: 200px; width: 70%; display:block;">
                                                      @else
                                                        <img class="page-preview mb-2 col-sm-5" >
                                                      @endif
                                                      <p class="text-primary mt-2">rekomendasi resolusi = (2836 x 648) dan maxsize = 2 MB </p>
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

                          function previewFront(){
                            const gambar = document.querySelector('#bg_front');
                            const gambarPreview = document.querySelector('.front-preview');

                            gambarPreview.style.display = 'block';
                            gambarPreview.style.height = '200px';
                            gambarPreview.style.width = '60%';


                            const oFReader = new FileReader();
                            oFReader.readAsDataURL(gambar.files[0]);

                            oFReader.onload = function(oFREvent){
                              gambarPreview.src = oFREvent.target.result;
                            }
                          }

                          function previewPage(){
                            const gambar = document.querySelector('#bg_page');
                            const gambarPreview = document.querySelector('.page-preview');

                            gambarPreview.style.display = 'block';
                            gambarPreview.style.height = '200px';
                            gambarPreview.style.width = '60%';

                            const oFReader = new FileReader();
                            oFReader.readAsDataURL(gambar.files[0]);

                            oFReader.onload = function(oFREvent){
                              gambarPreview.src = oFREvent.target.result;
                            }
                          }

                    </script>

                    </div> <!-- container -->



@endsection