@extends('backend.layouts.app')

@push('styles')
 <style>
    .note-editor p {
        margin-top: 0.5rem !important;
        margin-bottom: 0.5rem !important;
        line-height: 0.8; /* biar lebih rapat */
    }
</style>

@endpush

@push('script')

  <script src="{{asset('assets')}}/backend/js/vendor/summernote-lite.min.js"></script>
  <script>
    $('#visi').summernote({
        placeholder: 'Tulis visi di sini...',
        tabsize: 2,
        height: 200,
        toolbar: [
            ['style', ['bold', 'italic', 'underline']],
            ['font', ['fontsize']],
            ['para', ['paragraph']]
        ]
    });
</script>
<script>
    $('#misi').summernote({
        placeholder: 'Tulis misi di sini...',
        tabsize: 2,
        height: 200,
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
                                            <li class="breadcrumb-item active">Profil Gereja</li>
                                            <li class="breadcrumb-item active">Edit Visi-Misi</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Edit Visi-misi</h4>
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
                                                <form method="POST" action="{{route('backend.visi-misi.update', $visimisi->id )}}">
                                                    @csrf
                                                    @method('PUT')

                                                      <div class="mb-3">
                                                          <label class="form-label" for="visi">Visi </label>
                                                          <textarea id="visi" name="teks_visi" class="form-control @error('teks_visi') is-invalid @enderror">
                                                              {!! old('teks_visi', $visimisi->teks_visi) !!}
                                                          </textarea>
                                                          @error('teks_visi')
                                                            <small class="text-danger">{{ $message }}</small>
                                                          @enderror
                                                      </div>

                                                      <div class="mb-3">
                                                          <label class="form-label" for="misi">Misi </label>
                                                          <textarea id="misi" name="teks_misi" class="form-control @error('teks_misi') is-invalid @enderror">
                                                              {!! old('teks_misi', $visimisi->teks_misi) !!}
                                                          </textarea>
                                                          @error('teks_misi')
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