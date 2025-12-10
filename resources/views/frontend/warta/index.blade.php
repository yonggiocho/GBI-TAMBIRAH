@extends('frontend.layouts.app')

@section('content')

 <!-- Page Title -->
@include('frontend.partials.breadcrumbs')


        <!-- Blog Posts Section -->
    <section id="blog-posts" class="blog-posts section">

      <div class="container section-title" data-aos="fade-up">
        <h2>Daftar Warta</h2>
        <p>{{$identitas?->nama_website ?? ''}}</p>
    </div><!-- End Section Title -->

      <div class="container">
        <div class="row gy-4">
            @empty(!$wartas)
              @foreach($wartas as $warta)
                @if($warta->status === 'publish')
                  <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <article>


                      <div class="post-img position-relative">
                        <div class="position-absolute px-3 py-2 text-white " style="background-color:rgba(126, 87, 194, 1); margin-top:20px; border-bottom-right-radius: 10px; border-top-right-radius: 10px;">{{ucfirst($warta->kategori)}}</div>

                        <img src="{{asset('storage/'.$warta->gambar)}}" alt="" class="img-fluid">
                      </div>

                      <p class="post-category"><i class="bi bi-calendar2"></i> {{$warta->created_at->format('d F Y')}}</p>

                      <h4 class="title">
                        <a href="{{route('warta.detail',$warta->slug)}}">{{substr($warta->judul, 0, 100).'...'}}</a>
                      </h4>

                      <div class="d-flex align-items-center">
                        <div class="post-meta">
                          <p class="post-date">
                              {{substr(strip_tags($warta->isi), 0, 150).'...'}}
                          </p>
                          <br>
                          <p>
                            <a href="{{route('warta.detail',$warta->slug)}}">Baca Selengkapnya <i class="bi bi-arrow-right-short"></i></a>
                          </p>
                        </div>
                      </div>
                    </article>
                  </div><!-- End post list item -->
                @endif
              @endforeach
            @endempty



        </div>

      </div>

    </section><!-- /Blog Posts Section -->


      <div class="container">
        <div class="d-flex justify-content-center">
              {{ $wartas->links() }}
        </div>
      </div>


@endsection