@extends('frontend.layouts.app')

@section('content')

 <!-- Page Title -->
     @include('frontend.partials.breadcrumbs')
 <!-- End Page Title -->



    <!-- Visi-misi Section -->
          <section id="about" class="about section">

                <div class="container">

                    <div class="row gy-4">

                            <div class="col-lg-5 content" data-aos="fade-up" data-aos-delay="100">
                                <div class="card h-100 border-0 shadow rounded-2 px-4">
                                    <div class="card-body px-3">
                                        <h3 class="text-center mb-3"><b>VISI</b></h3>
                                        @empty(!$teks)
                                            {!!$teks->teks_visi!!}
                                        @endempty
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-7" data-aos="fade-up" data-aos-delay="200">
                                <div class="card h-100 border-0 shadow rounded-2 px-3">
                                        <div class="card-body px-3">
                                        <h3 class="text-center mb-3"><b>MISI </b></h3>
                                        @empty(!$teks)
                                            {!!$teks->teks_misi!!}
                                        @endempty
                                        </div>
                                </div>
                            </div>

                    </div>

                </div>

        </section><!-- /visi-misi Section -->



@endsection