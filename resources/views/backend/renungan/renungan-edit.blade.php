@extends('backend.layouts.app')

@push('styles')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet">
  <style>
      .select2-container--bootstrap-5 .select2-selection {

          border-color: #ced4da !important;
          padding: 0.5rem 0.75rem !important;
          min-height: 45px !important;
          box-shadow: none !important;
          transition: box-shadow 0.2s ease;
      }

      .select2-container--bootstrap-5 .select2-selection:focus {
          border-color: #86b7fe !important;
          box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, .25) !important;
      }

      .select2-dropdown {
          border-radius: 0.75rem !important;
          box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
      }
  </style>

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
                                                        <label for="nameSelect" class="form-label">Kategori</label>
                                                        <select class="form-select select2" name="kategori" id="nameSelect" >
                                                            <option hidden>Pilih Kategori</option>
                                                            @foreach($kategoris as $kategori)
                                                                <option value="{{$kategori->kategori}}" {{old('kategori', $renungan->kategori) == $kategori->kategori ? 'selected':''}}>{{ $kategori->kategori }}</option>
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

@push('script')
<script src="{{asset('assets')}}/backend/js/vendor/summernote-lite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  $(document).ready(function () {
    $('.select2').select2({
        theme: 'bootstrap-5'
    });
});
</script>


  <script>
    $('#isi-renungan').summernote({
        placeholder: 'Tulis isi renungan di sini...',
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


@endsection