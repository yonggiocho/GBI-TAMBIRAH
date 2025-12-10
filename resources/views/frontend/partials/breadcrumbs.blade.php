  <div class="page-title dark-background" data-aos="fade" style="background-image: url({{$banner?->bg_page ? asset('storage/'.$banner->bg_page) : asset('assets/frontend/img/page-title-bg.jpg')}});">
            <div class="container position-relative">

                <h1>{{$breadcrumbs[2] ?? $breadcrumbs[1] }}</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{route('beranda')}}">{{$breadcrumbs[0]}}</a></li>
                        <li class="current">{{$breadcrumbs[1]}}</li>
                        @if($breadcrumbs[2]??'')<li class="current">{{$breadcrumbs[2]}}</li>@endif
                    </ol>
                </nav>
    </div>
</div><!-- End Page Title -->