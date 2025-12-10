<nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{route('beranda')}}" class="{{ request()->routeIs('beranda') ? 'active' : '' }}">Beranda</a></li>
         <li class="dropdown "><a href="{{route('profil.sejarah')}}" class="{{ request()->routeIs('profil*') ? 'active' : '' }}"><span>Profil</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="{{route('profil.sejarah')}}" >Sejarah</a></li>
              <li><a href="{{route('profil.visi-misi')}}">Visi & Misi</a></li>
              <li><a href="{{route('profil.pengurus')}}">Pengurus</a></li>
            </ul>
          </li>
          <li><a href="{{route('warta')}}" class="{{ request()->routeIs('warta*') ? 'active' : '' }}">Warta</a></li>
          <li><a href="{{route('renungan')}}" class="{{ request()->routeIs('renungan*') ? 'active' : '' }}">Renungan</a></li>
          <li><a href="{{route('galeri')}}" class="{{ request()->routeIs('galeri') ? 'active' : '' }}">Galeri</a></li>
          <li><a href="{{route('kontak')}}" class="{{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a></li>

        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <div><!-- agar menu tetap ditengah--></div>