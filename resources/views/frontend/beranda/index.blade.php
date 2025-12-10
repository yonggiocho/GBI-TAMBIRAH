
@extends('frontend.layouts.app')

@section('content')
            <section id="hero" class="hero section dark-background">
                <img src="{{ $banner?->bg_front ? asset('storage/'.$banner->bg_front) : asset('assets/frontend/img/banner.jpg')}}" alt="" data-aos="fade-in">
                <div class="container d-flex flex-column align-items-center text-center">
                    <h3 data-aos="fade-up" data-aos-delay="100">Selamat Datang di</h3>
                    <h2 data-aos="fade-up" data-aos-delay="200">{{$banner?->title ?? ''}}</h2>
                    {{-- <div data-aos="fade-up" data-aos-delay="300">
                    <a href="https://www.youtube.com/watch?v=aPBIE05a0Ds" class="glightbox pulsating-play-btn"></a>
                    </div> --}}
                </div>
            </section><!-- /Hero Section -->


            <!-- Visi-misi Section -->
          <section id="about" class="about section ">

                <div class="container">

                    <div class="row gy-4">

                    <div class="col-lg-6 text-center content" data-aos="fade-up" data-aos-delay="100">
                      <h3><b>Visi </b></h3>
                      @empty(!$visimisi)
                      <div class="px-5">{!!$visimisi->teks_visi!!} </div>
                      @endempty
                    </div>

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <h3 class="text-center"><b>Misi </b></h3>
                        @empty(!$visimisi)
                        <h5 class="px-3">{!!$visimisi->teks_misi!!} </h5>
                        @endempty
                    </div>

                    </div>

                </div>
        </section><!-- visi-misi Section -->

        <section>
            <div class="container">

                <div style="margin-bottom: 60px;" class="container" data-aos="fade-up">
                    <h3 class="text-center"><b>Pengurus</b></h3>
                </div><!-- End Section Title -->

                    <div class="row justify-content-center">
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
                                <h6 class="card-title fw-bold">{{$p->jabatan}}</h6>
                                <!-- Jabatan -->
                                <p class="card-text">{{$p->gelar_depan == '-' ? '' : $p->gelar_depan.'. '}}{{$p->nama}}{{$p->gelar_belakang == '-' ? '':', '.$p->gelar_belakang}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endempty
                    </div><!-- End recent posts list -->
            </div>
        </section>


            <!-- Recent Posts Section -->
            <section id="recent-posts" class="recent-posts section light-background">

                <!-- Section Title -->
                <div style="margin-bottom: 60px;" class="container" data-aos="fade-up">
                    <h3 class="text-center"><b>Warta Terbaru</b></h3>
                </div><!-- End Section Title -->

                <div class="container">

                    <div class="row justify-content-center gy-4">
                      @empty(!$wartas)
                        @foreach($wartas as $warta)
                            @if($warta->status === 'publish')
                            <div class="col-xl-4 col-md-6 mt-4" data-aos="fade-up" data-aos-delay="100">
                                <article>
                                    <div class="post-img position-relative">
                                        <div class="position-absolute px-3 py-2 text-white " style="background-color:rgba(126, 87, 194, 1); margin-top:20px; border-bottom-right-radius: 10px; border-top-right-radius: 10px;">{{ucfirst($warta->kategori)}}</div>
                                        <img src="{{asset('storage/'.$warta->gambar)}}" alt="" class="img-fluid">
                                    </div>
                                    <p class="post-category"><i class="bi bi-calendar2"></i> {{\Carbon\Carbon::parse($warta->created_at)->format('d M Y')}}</p>
                                    <h5 class="title">
                                        <a href="{{route('warta.detail',$warta->slug)}}">{{substr($warta->judul, 0, 100).'...'}}</a>
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <div class="post-meta">
                                        <p class="post-date">
                                            {{substr(strip_tags($warta->isi), 0, 150).'...'}}
                                        </p>
                                        <br>
                                        <p><a  href="{{route('warta.detail', $warta->slug)}}">Baca Selengkapnya <i class="bi bi-arrow-right-short"></i></a></p>
                                        </div>

                                    </div>
                                </article>
                            </div><!-- End post list item -->
                            @endif
                        @endforeach
                    @endempty


                    </div><!-- End recent posts list -->

                </div>
            </section><!-- /Recent Posts Section -->



 @endsection