@extends('backend.layouts.app')
@push('script')
<script src="{{asset('assets')}}/backend/js/vendor/summernote-lite.min.js"></script>
  <script>
    $('#isi-renungan').summernote({
        placeholder: 'Tulis isi renungan di sini...',
        tabsize: 2,
        height: 300,
        toolbar: [
            ['style', ['bold', 'italic', 'underline']],
            ['font', ['fontsize']],
            ['para', ['paragraph']]
        ]
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
                                            <li class="breadcrumb-item active">Beranda</li>
                                            <li class="breadcrumb-item active">Edit Renungan</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Renungan</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">


                                      <form method="POST" action="{{route('backend.renungan.update', $renungan->id)}}" enctype="multipart/form-data">

                                        @csrf
                                        @method('PUT')

                                        <div class="row">
                                          <div class="col-xl-12">

                                                <div class="mb-3">
                                                    <label for="judul" class="form-label">Judul</label>
                                                    <input type="text" id="judul" name="judul" class="form-control" placeholder="Masukkan judul . . ." value="{{ old('judul', $renungan->judul)}}">
                                                      @error('judul')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="isi" class="form-label">Isi</label>
                                                    <textarea id="isi-renungan" name="isi" class="form-control @error('isi') is-invalid @enderror">
                                                      {!! $renungan->isi!!}
                                                    </textarea>
                                                    @error('isi')
                                                            <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="mb-3 overflow-hidden">
                                                    <label for="gambar" class="form-label">Gambar</label>

                                                    @if($renungan->gambar)
                                                    <img class="gambar-preview img-fluid mb-3 col-sm-5" src="{{asset('storage/'.$renungan->gambar)}}" style="width: 250px; display:block;">
                                                    @else
                                                    <img class="gambar-preview img-fluid mb-3 col-sm-5" style="height: 150px; width: 250px; ">
                                                    @endif
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
                                              <button class="btn btn-primary" type="submit"><i class="uil-file-edit-alt"></i> Ubah</button>
                                              <a href="{{route('backend.renungan')}}" class="btn btn-danger" ><i class="uil-sign-in-alt"></i> Kembali</a>
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
                            gambarPreview.style.width = '300px';

                            const oFReader = new FileReader();
                            oFReader.readAsDataURL(gambar.files[0]);

                            oFReader.onload = function(oFREvent){
                              gambarPreview.src = oFREvent.target.result;
                            }
                          }

                    </script>

                    </div> <!-- container -->



@endsection