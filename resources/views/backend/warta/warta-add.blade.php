@extends('backend.layouts.app')
@push('script')
<script src="{{asset('assets')}}/backend/js/vendor/summernote-lite.min.js"></script>
  <script>
    $('#isi-warta').summernote({
        placeholder: 'Tulis isi warta di sini...',
        tabsize: 2,
        height: 250,
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
                                    <div class="page-2title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item active">Beranda</li>
                                            <li class="breadcrumb-item active">Tambah Warta</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Tambah Warta</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">


                                      <form method="POST" action="{{route('backend.warta.store')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                          <div class="col-xl-12">
                                                <div class="mb-3">
                                                    <label for="judul" class="form-label">Judul</label>
                                                    <input type="text" id="judul" name="judul" class="form-control" placeholder="Masukkan judul . . ." value="{{ old('judul')}}">
                                                      @error('judul')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="kategori" class="form-label">Kategori</label>
                                                    <select name="kategori" id="kategori" class="form-select" required>
                                                        <option value="" hidden>Pilih Kategori</option>
                                                       @foreach ($kategori as $k)
                                                        <option value="{{$k}}" {{ old('kategori') == $k ? 'selected' : '' }}>{{ucfirst($k)}}</option>
                                                       @endforeach
                                                    </select>
                                                     @error('kategori')
                                                        <small class="form-text text-danger">
                                                          {{$message}}
                                                        </small>
                                                      @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="isi" class="form-label">Isi</label>
                                                    <textarea id="isi-warta" name="isi" class="form-control @error('isi') is-invalid @enderror">

                                                    </textarea>
                                                    @error('isi')
                                                            <small class="text-danger">{{ $message }}</small>
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
                                              <button class="btn btn-success" type="submit"><i class="uil-file-plus-alt"></i> Simpan</button>
                                              <a href="{{route('backend.warta')}}" class="btn btn-danger" ><i class="uil-sign-in-alt"></i> Kembali</a>
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