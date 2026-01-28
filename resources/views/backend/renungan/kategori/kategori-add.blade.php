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
                                            <li class="breadcrumb-item active">Tambah Kategori</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Tambah Kategori Renungan</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">


                                      <form method="POST" action="{{route('backend.kategori.renungan.store')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                          <div class="col-xl-12">
                                                <div class="mb-3">
                                                    <label for="kategori" class="form-label">Judul Kategori</label>
                                                    <input type="text" id="kategori" name="kategori" class="form-control" placeholder="Masukkan judul kategori..." value="{{ old('kategori')}}">
                                                      @error('kategori')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                </div>


                                                <div class="mb-3">
                                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                                    <textarea name="deskripsi" class="form-control"></textarea>
                                                    @error('deskripsi')
                                                            <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="thumbnail" class="form-label">Thumbnail</label>
                                                    <img class="thumbnail-preview img-fluid mb-3 col-sm-5" >
                                                    <input type="file" id="thumbnail" name="thumbnail" class="form-control" onchange="previewThumbnail()">
                                                      @error('thumbnail')
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
                                              <button class="btn btn-success" type="submit"><i class="uil-file-plus-alt"></i> Simpan</button>
                                              <a href="{{route('backend.kategori.renungan')}}" class="btn btn-danger" ><i class="uil-sign-in-alt"></i> Kembali</a>
                                          </div>
                                        </div>
                                      </form>

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->

                         <script>

                          function previewThumbnail(){
                            const thumbnail = document.querySelector('#thumbnail');
                            const thumbnailPreview = document.querySelector('.thumbnail-preview');

                            thumbnailPreview.style.display = 'block';
                            thumbnailPreview.style.height = '150px';
                            thumbnailPreview.style.width = '300px';

                            const oFReader = new FileReader();
                            oFReader.readAsDataURL(thumbnail.files[0]);

                            oFReader.onload = function(oFREvent){
                              thumbnailPreview.src = oFREvent.target.result;
                            }
                          }

                    </script>

      </div> <!-- container -->



@endsection