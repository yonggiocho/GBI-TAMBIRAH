@extends('frontend.layouts.app')

@section('content')

        <!-- Page Title -->
          @include('frontend.partials.breadcrumbs')


        <!-- Recent Posts Section -->
            <section id="recent-posts" class="recent-posts section">

                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <h2>Daftar Pengurus</h2>
                    <p>Gereja Bethel Indonesia Jemaat Tumbang Tambirah</p>
                </div><!-- End Section Title -->

                <div class="container">

                    <div class="row gy-4">
                    @empty(!$pengurus)
                        @foreach($pengurus as $p)
                        <div class="col-xl-3">
                            <div class="card h-100 text-center border-0 shadow rounded-4">
                                <div class="card-body">
                                <!-- Foto -->
                                <a href="{{asset('storage/'.$p->gambar) }}" data-lightbox="{{$p->jabatan}}" data-title="{{$p->gelar_depan == '-' ? '' : $p->gelar_depan.'. '}}{{$p->nama}}{{$p->gelar_belakang == '-' ? '':', '.$p->gelar_belakang}}">
                                <img src="{{asset('storage/'.$p->gambar) }}" class="img-fluid mb-3" alt="Struktur Pengurus"
                                    style="padding: 10px; height:300px; object-fit: cover;">
                                </a>
                                <!-- Nama -->
                                <h6 class="card-title fw-bold">{{$p->gelar_depan == '-' ? '' : $p->gelar_depan.'. '}}{{$p->nama}}{{$p->gelar_belakang == '-' ? '':', '.$p->gelar_belakang}}</h6>
                                <!-- Jabatan -->
                                <p class="card-text">{{$p->jabatan}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endempty
                    </div><!-- End recent posts list -->

                </div>
            </section><!-- /Recent Posts Section -->


@endsection