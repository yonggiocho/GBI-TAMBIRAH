@extends('backend.layouts.app')

@push('styles')
 <style>
    .note-editor p {
        margin-top: 0.5rem !important;
        margin-bottom: 0.5rem !important;
        line-height: 1.4; /* biar lebih rapat */
    }
</style>

@endpush

@push('script')

  <script src="{{asset('assets')}}/backend/js/vendor/summernote-lite.min.js"></script>
  <script>
    $('#isi').summernote({
        placeholder: 'Tulis isi sejarah di sini...',
        tabsize: 2,
        height: 320,
        toolbar: [
            ['style', ['bold', 'italic', 'underline']],
            ['font', ['fontsize']],
            ['para', ['ul', 'ol', 'paragraph']],

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
                                            <li class="breadcrumb-item active">Profil Gereja</li>
                                            <li class="breadcrumb-item active">Sejarah</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Edit Sejarah</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                      <div class="tab-content">
                                            <div class="tab-pane show active" id="custom-styles-preview">
                                                <form id="sejarah-form" method="POST" action="{{route('backend.sejarah.update', $sejarah->id )}}">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label class="form-label" for="judul">Judul</label>

                                                        <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $sejarah->judul) }}"  placeholder="Judul">

                                                        @error('judul') <small class="form-text text-danger">
                                                            {{$message}}
                                                        @enderror</small>
                                                    </div>

                                                       <div class="mb-3">
                                                          <label class="form-label" for="isi">Isi</label>
                                                          <textarea id="isi" name="isi" class="form-control @error('isi') is-invalid @enderror">
                                                              {!! old('isi', $sejarah->isi) !!}
                                                          </textarea>
                                                          @error('isi')
                                                            <small class="text-danger">{{ $message }}</small>
                                                          @enderror
                                                      </div>

                                                    <button class="btn btn-success" type="submit"><i class="uil-file-edit-alt"></i> Simpan</button>

                                                </form>
                                            </div> <!-- end preview-->


                                        </div> <!-- end tab-content-->

                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                    </div>
  </div>

@endsection

