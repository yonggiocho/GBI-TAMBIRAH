@extends('frontend.layouts.app')

@section('content')

<main class="main">

 <!-- Page Title -->
@include('frontend.partials.breadcrumbs')


    <div class="container">
      <div class="row">

        <div class="col-lg-8">

          <!-- Blog Details Section -->
          <section id="blog-details" class="blog-details section">
            <div class="container">

              <article class="article rounded-3">
                <div class="post-img overflow-hidden rounded-top-3">
                  <div class="position-absolute px-3 py-2 text-white " style="background-color:rgba(126, 87, 194, 1); margin-top:20px; border-bottom-right-radius: 10px; border-top-right-radius: 10px;">{{$renungan[0]->kategori}}</div>
                  <img src="{{ $renungan[0]->gambar !== '/img/no_image.jpg' ? asset('storage/'.$renungan[0]->gambar) : asset('storage'.$renungan[0]->gambar) }}" alt="" class="img-fluid" style="height:400px; width: 100%; object-fit:cover">
                </div>

                <h2 class="title">{{$renungan[0]->judul}}</h2>

                <div class="meta-top">
                  <ul>
                    <li class="d-flex align-items-center"><i class="bi bi-person"></i>{{$renungan[0]->penulis}}</li>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> {{$renungan[0]->created_at->diffForHumans()}}</li>
                  </ul>
                </div><!-- End meta top -->

                <div class="content mb-4">
                   {!!$renungan[0]->isi!!}
                </div><!-- End post content -->

                <div class="meta-bottom">
                   <strong>Bagikan:</strong>
                        <div class="d-flex gap-2 mt-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank">
                                <img class="rounded-2" src="{{ asset('assets/frontend/img/facebook.png') }}" width="40">
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($renungan[0]->judul . ' ' . request()->fullUrl()) }}" target="_blank">
                                <img class="rounded-2" src="{{ asset('assets/frontend/img/whatapps.png')  }}" width="40">
                            </a>
                        </div>
                </div><!-- End meta bottom -->
              </article>

            </div>
          </section><!-- /Blog Details Section -->




        </div>

        <div class="col-lg-4 sidebar">
          <div class="widgets-container rounded-3">
            <!-- Recent Posts Widget -->
            <div class="recent-posts-widget widget-item">
              <h3 class="widget-title">Renungan Terbaru</h3>
              @foreach($renungan[1] as $baru)
                @if($baru->status == 'publish')
                <div class="post-item overflow-hidden">
                  <img src="{{ $baru->gambar !== '/img/no_image.jpg' ? asset('storage/'.$baru->gambar) : asset('storage'.$baru->gambar) }}" alt="" class="flex-shrink-0" style="height: 60px; object-fit:cover;">
                  <div>
                    <h4><a href="{{route('renungan.detail',$baru->slug)}}">{{substr($baru->judul,0, 50).'...'}}</a></h4>
                    <time datetime="">{{\Carbon\Carbon::parse($baru->created_at)->format('d-m-Y')}}</time>
                  </div>
                </div><!-- End recent post item-->
                @endif
              @endforeach
            </div>
            <!--/Recent Posts Widget -->
          </div>
        </div>

      </div> <!-- END ROW -->
    </div>

  </main>
@endsection