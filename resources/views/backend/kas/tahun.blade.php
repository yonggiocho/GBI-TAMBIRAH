@extends('backend.layouts.app')

@section('content-backend')


    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{route('backend.beranda')}}">Beranda</a></li>
                                            <li class="breadcrumb-item active">Tahun Kas</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Tahun Kas</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <button  type="button" class="btn btn-success btn-rounded mb-3" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm"> <i class="mdi mdi-plus"></i>Tambah Tahun</button>
                            </div>
                            <div class="modal fade" id="bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="mySmallModalLabel">Tambah Tahun</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('kas.tambahTahun') }}" method="POST" class="mb-3">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label">Tahun</label>
                                                    <input type="number" name="tahun" class="form-control" placeholder="Masukkan Tahun">
                                                </div>
                                                <div class="mb-3 d-flex justify-content-end gap-1">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-success">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            @foreach($tahun as $t)
                                <div class="col-md-3">
                                    <div class="card border-primary border">
                                        <div class="card-body">
                                            <h3 class="card-title text-primary">Tahun {{ $t->tahun }}</h3>
                                            <p class="card-text">Klik lanjutkan untuk pengisian</p>
                                            <a href="{{ route('kas.showBulan', $t->id) }}" class="btn btn-primary btn-sm">Lanjutkan</a>
                                        </div> <!-- end card-body-->
                                    </div> <!-- end card-->
                                </div> <!-- end col-->
                            @endforeach
                        </div>
                        <!-- end row -->

    </div> <!-- container -->

@endsection