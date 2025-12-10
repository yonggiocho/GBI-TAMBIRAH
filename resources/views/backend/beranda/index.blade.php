@extends('backend.layouts.app')


@section('content-backend')

    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">

                                    <h4 class="page-title">Beranda</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->


                        <div class="row">
                             <div class="col-12">
                                <div class="alert alert-success" role="alert">
                                    <h3 class="alert-heading">Selamat Datang, {{auth()->user()->name}}!</h3>
                                    <p>Dashboard Manajemen Gereja dan Pengelolaan Konten Website <strong> {{$identitas?->nama_website??'Nama website'}} </strong>  </p>

                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card widget-inline">
                                    <div class="card-body p-0">
                                        <div class="row g-0">
                                            <div class="col-sm-6 col-xl-12">
                                                <div class="card shadow-none m-0">
                                                    <div class="card-body text-center">
                                                        <i class="dripicons-article text-success" style="font-size: 24px;"></i>
                                                        <h3><span>{{$warta}}</span></h3>
                                                        <p class="text-muted font-15 mb-0">Total Warta</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card widget-inline">
                                    <div class="card-body p-0">
                                        <div class="row g-0">
                                            <div class="col-sm-6 col-xl-12">
                                                <div class="card shadow-none m-0">
                                                    <div class="card-body text-center">
                                                        <i class="dripicons-message text-primary" style="font-size: 24px;"></i>
                                                        <h3><span>{{$renungan}}</span></h3>
                                                        <p class="text-muted font-15 mb-0">Total Renungan</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card widget-inline">
                                    <div class="card-body p-0">
                                        <div class="row g-0">
                                            <div class="col-sm-6 col-xl-12">
                                                <div class="card shadow-none m-0">
                                                    <div class="card-body text-center">
                                                        <i class="dripicons-photo-group text-warning" style="font-size: 24px;"></i>
                                                        <h3>{{$galeri}}</h3>
                                                        <p class="text-muted font-15 mb-0">Total Foto</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="card widget-inline">
                                    <div class="card-body p-0">
                                        <div class="row g-0">
                                            <div class="col-sm-6 col-xl-12">
                                                <div class="card shadow-none m-0">
                                                    <div class="card-body text-center">
                                                        <i class="dripicons-user-id text-danger" style="font-size: 24px;"></i>
                                                        <h3><span>{{$akun}}</span></h3>
                                                        <p class="text-muted font-15 mb-0">Total Akun</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         </div>

                         <div class="row">

                            <div class="col-3">
                                <div class="card widget-inline">
                                    <div class="card-body p-0">
                                        <div class="row g-0">
                                            <div class="col-sm-6 col-xl-12">
                                                <div class="card shadow-none m-0">
                                                    <div class="card-body text-center">
                                                        <i class="dripicons-user text-info" style="font-size: 24px;"></i>
                                                        <h3><span>{{$jemaat}}</span></h3>
                                                        <p class="text-muted font-15 mb-0">Total Jemaat</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <div class="col-3">
                                <div class="card widget-inline">
                                    <div class="card-body p-0">
                                        <div class="row g-0">
                                            <div class="col-sm-6 col-xl-12">
                                                <div class="card shadow-none m-0">
                                                    <div class="card-body text-center">
                                                        <i class="dripicons-user-group text-secondary" style="font-size: 24px;"></i>
                                                        <h3><span>{{$keluarga}}</span></h3>
                                                        <p class="text-muted font-15 mb-0">Total Kepala Keluarga</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>





                        <!-- end row-->

    </div> <!-- container -->
@endsection