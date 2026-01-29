@extends('frontend.layouts.app')

@section('content')

 <!-- Page Title -->
@include('frontend.partials.breadcrumbs')


        <!-- Blog Posts Section -->
    <section id="blog-posts" class="blog-posts section">

      <div class="container section-title" data-aos="fade-up">
        <h2>Kategori Renungan : <span style="font-style: italic;color:green">{{$kategori ?? ''}}</span></h2>
        <p>{{$identitas?->nama_website ?? ''}}</p>
    </div><!-- End Section Title -->


    <div class="container">
       <div class="row gy-4">

    <!-- SIDEBAR -->
    <div class="col-md-3">
      <h5 class="mb-3">Kategori</h5>
      <ul class="list-group list-group-flush" >
        @forelse($kategoriRenungans as $katRenungan)
        <li class="list-group-item d-flex justify-content-between align-items-center"><a href="{{route('renungan.kategori',$katRenungan->kategori)}}">{{$katRenungan->kategori}}</a><span class="badge bg-success rounded-pill">{{$katRenungan->total}}</span></li>
        @empty
        <li class="list-group-item d-flex justify-content-between align-items-center">Belum Ada Kategori</li>
        @endforelse
      </ul>
    </div>

    <!-- KONTEN -->
    <div class="col-md-9">

      @forelse($renungans as $renungan)
        @if($renungan->status == 'publish')

        <div class="row mb-4 align-items-start">

          <!-- GAMBAR -->
          <div class="col-md-4">
            <div style="width:100%; height:180px; overflow:hidden; border-radius:8px; background:#f3f3f3;">
              <img src="{{ asset('storage/'.$renungan->gambar) }}" style="width:100%; height:100%; object-fit:cover;">
            </div>
          </div>

          <!-- TEKS -->
          <div class="col-md-8">
            <small class="text-muted">
              <b class="text-success">{{ ucfirst($renungan->kategori) }} </b> |

              {{ $renungan->created_at->format('d F Y') }}
            </small>


            <h4 class="mt-2">
              <a href="{{ route('renungan.detail',$renungan->slug) }}">
                {{ $renungan->judul }}
              </a>
            </h4>

            <p>
              {{ Str::limit(strip_tags($renungan->isi), 150) }}

            </p>


            <a href="{{ route('renungan.detail',$renungan->slug) }}">
              Selengkapnya <i class="bi bi-arrow-right-short"></i>
            </a>
          </div>

        </div>

        @endif
      @empty
        <h2>Tidak ada renungan.</h2>
      @endforelse

    </div>

  </div>
</div>


    </section><!-- /Blog Posts Section -->


      <div class="container">
        <div class="d-flex justify-content-center">
              {{ $renungans->links() }}
        </div>
      </div>


@endsection