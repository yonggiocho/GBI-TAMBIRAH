@extends('frontend.layouts.app')

@section('content')

@include('frontend.partials.breadcrumbs')
    <section id="portfolio" class="portfolio section">
                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <h2>Galeri</h2>
                    <p>{{$identitas?->nama_website ?? '-'}}</p>
                </div><!-- End Section Title -->
                @empty(!$galeris)
                    <div class="container-fluid px-5">
                        <div class="row" data-aos="fade-up" data-aos-delay="200">
                            @foreach($galeris as $galeri)
                            <div class="col-md-3 mb-4 position-relative">

                                 <div class="position-absolute px-3 py-2 text-white " style="background-color:rgba(126, 87, 194, 1); border-bottom-right-radius: 15px;">
                                   <small> {{ \Carbon\Carbon::parse($galeri->tanggal)->format('d-m-Y')}} </small>
                                </div>


                                <a href="{{ asset('storage/'.$galeri->gambar) }}" data-lightbox="gbi-tambirah" data-title="{{substr($galeri->judul,0,120)}}">

                                    <img src="{{ asset('storage/'.$galeri->gambar) }}" class="img-fluid img-thumbnail" alt="judul" style="height:300px; width:320px; object-fit:cover;"  >

                                </a>

                                 <div class="mt-2 text-center">
                                    <h6 class="mb-0">
                                        {{ substr($galeri->judul,0,30).'...' }}
                                    </h6>
                                </div>


                            </div>

                            @endforeach
                        </div>
                    </div>
                    <div class="container">
                        <div class="d-flex justify-content-center">
                                {{ $galeris->links() }}
                        </div>
                    </div>
                @endempty
    </section><!-- /Portfolio Section -->
@endsection