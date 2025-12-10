<footer id="footer" class="footer dark-background">
    <div class="container">
      <a href="{{route('beranda')}}" class="sitename">
          <img src="{{ $identitas?->logo ? asset('storage/'.$identitas->logo) : asset('assets/frontend/img/logo/gbi-tt.png')}}" alt="Gereja Bethel Indonesia Tumbang Tambirah" style="height: 80px;">
      </a>
      <p>Alamat : {{$identitas?->alamat??'-'}}</p>
      <h6 style="display: inline-block">Ikuti kami :</h6>
      <div class="social-links d-flex justify-content-center">

        <a href="{{$identitas?->facebook??'#'}}" target="_blank"><i class="bi bi-facebook"></i></a>
        <a href="{{$identitas?->instagram??'#'}}" target="_blank"><i class="bi bi-instagram"></i></a>
        <a href="{{$identitas?->youtube??'#'}}" target="_blank"><i class="bi bi-youtube"></i></a>
      </div>


      <div class="container">
        <div class="copyright">
          © 2025 {{$identitas?->nama_website??'Nama website'}}</span>
        </div>

      </div>
    </div>
  </footer>