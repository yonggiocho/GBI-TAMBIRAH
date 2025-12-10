@extends('frontend.layouts.app')

@section('content')

<div class="page-title dark-background" data-aos="fade" style="background-image: url({{$banner?->bg_page ? asset('storage/'.$banner->bg_page) : asset('assets/frontend/img/page-title-bg.jpg')}});">
            <div class="container position-relative">
              <nav class="breadcrumbs mb-3">
                    <ol>
                        <li><a href="{{route('beranda')}}">{{$breadcrumbs[0]}}</a></li>
                        <li class="current">{{$breadcrumbs[1]}}</li>
                        @if($breadcrumbs[2]??'')<li class="current">{{$breadcrumbs[2]}}</li>@endif
                    </ol>
                </nav>

                <h1>{{$breadcrumbs[2] ?? $breadcrumbs[1] }}</h1>
                <h4>Terhubung dengan gereja kami</h4>

          </div>
</div><!-- End Page Title -->


<!-- Contact Section -->
    <section id="contact" class="contact section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Kontak</h2>
        <p>{{$kontak?->nama_website??''}}</p>
      </div><!-- End Section Title -->



      <div class="container" data-aos="fade" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-4">

                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="100">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                  <div>
                      <h3>Alamat</h3>
                      <p>{{$kontak?->alamat ?? '-'}}</p>
                  </div>
                </div><!-- End Info Item -->


                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="100">
                <i class="bi bi-telephone flex-shrink-0"></i>
                  <div>
                      <h3>Telepon</h3>
                      <p>{{$kontak?->telepon??'-'}}</p>
                  </div>
                </div><!-- End Info Item -->

                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="100">
                <i class="bi bi-envelope flex-shrink-0"></i>
                  <div>
                      <h3>Email</h3>
                      <p>{{$kontak?->email??'-'}}</p>
                  </div>
                </div><!-- End Info Item -->

            </div>

          <div class="col-lg-8">
            <iframe class="rounded-4" src="{{$kontak?->map??'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4217.6031812091205!2d113.86971567521508!3d-1.114814598874499!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dfc1df0f6a13b65%3A0xf310218b8166a0db!2sHOLMES%20MUSIK%20STUDIO!5e1!3m2!1sid!2sid!4v1763366461361!5m2!1sid!2sid'}}"
             width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->
@endsection