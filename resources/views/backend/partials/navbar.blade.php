<!-- ========== Left Sidebar Start ========== -->
            <div class="leftside-menu">

                <!-- LOGO -->
                <a href="{{route('backend.beranda')}}" class="logo text-center logo-light">
                    <span class="logo-lg">
                        <img src="{{ asset('assets/backend/images/gbi.png')}}" alt="" height="35">
                    </span>
                    <span class="logo-sm">
                        <img src="{{asset('assets/backend/images/gbi.png')}}" alt="" height="35">
                    </span>
                </a>

                <!-- LOGO -->
                <a href="{{route('backend.beranda')}}" class="logo text-center logo-dark">
                    <span class="logo-lg">
                        <img src="{{asset('assets/backend/images/gbi.png')}}" alt="" height="35">
                    </span>
                    <span class="logo-sm">
                        <img src="{{asset('assets/backend/images/gbi.png')}}" alt="" height="35">
                    </span>
                </a>

                <div class="h-100" id="leftside-menu-container" >

                    <!--- Sidemenu -->
                    <ul class="side-nav">

                        <li class="side-nav-title side-nav-item">Dashboard</li>


                        <li class="side-nav-item  {{ request()->routeIs('backend.beranda') ? 'menuitem-active' : '' }}">
                            <a href="{{route('backend.beranda')}}" class="side-nav-link">
                                <i class="uil-monitor"></i>
                                <span>Beranda</span>
                            </a>
                        </li>


                        <li class="side-nav-title side-nav-item">Manajemen Publikasi</li>

                        <li class="side-nav-item {{ request()->routeIs('backend.sejarah*','backend.visi-misi*', 'backend.pengurus*') ? 'menuitem-active' : '' }}">
                            <a data-bs-toggle="collapse" href="#sidebarTasks" aria-expanded="false" aria-controls="sidebarTasks" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span>Profil</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse {{ request()->routeIs('backend.sejarah*','backend.visi-misi*', 'backend.pengurus*') ? 'show' : '' }}" id="sidebarTasks">
                                <ul class="side-nav-second-level">
                                    <li class="{{ request()->routeIs('backend.sejarah*') ? 'menuitem-active' : '' }}">
                                        <a href="{{route('backend.sejarah')}}">Sejarah</a>
                                    </li>
                                    <li class="{{ request()->routeIs('backend.visi-misi*') ? 'menuitem-active' : '' }}">
                                        <a href="{{route('backend.visi-misi')}}">Visi-Misi</a>
                                    </li>
                                    <li class="{{ request()->routeIs('backend.pengurus*') ? 'menuitem-active' : '' }}">
                                        <a href="{{route('backend.pengurus')}}">Pengurus</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="side-nav-item {{ request()->routeIs('backend.warta*') ? 'menuitem-active' : '' }}">
                            <a href="{{route('backend.warta')}}" class="side-nav-link">
                                <i class="uil-newspaper"></i>
                                <span>Warta</span>
                            </a>
                        </li>

                        <li class="side-nav-item  {{ request()->routeIs('backend.renungan*') ? 'menuitem-active' : '' }}">
                            <a href="{{route('backend.renungan')}}" class="side-nav-link">
                                <i class="uil-notebooks"></i>
                                <span>Renungan</span>
                            </a>
                        </li>

                        <li class="side-nav-item  {{ request()->routeIs('backend.galeri*') ? 'menuitem-active' : '' }}">
                            <a href="{{route('backend.galeri')}}" class="side-nav-link">
                                <i class="uil-images"></i>
                                <span> Galeri </span>
                            </a>
                        </li>

                    @if(auth()->user()->isAdmin())
                        <li class="side-nav-item {{ request()->routeIs('backend.identitas*') ? 'menuitem-active' : '' }}">
                            <a href="{{ route('backend.identitas.edit')}}" class="side-nav-link">
                                <i class="uil-user-square"></i>
                                <span>Identitas</span>
                            </a>
                        </li>

                        <li class="side-nav-item {{ request()->routeIs('backend.banner*') ? 'menuitem-active' : '' }}">
                            <a href="{{ route('backend.banner.edit')}}" class="side-nav-link">
                                <i class="uil-image-edit"></i>
                                <span>Banner</span>
                            </a>
                        </li>
                    @endif




                    @if(auth()->user()->isAdmin())
                        <li class="side-nav-title side-nav-item">Manajemen Gereja</li>

                        <li class="side-nav-item {{ request()->routeIs('backend.jemaat*','backend.keluarga*') ? 'menuitem-active' : '' }}">
                            <a data-bs-toggle="collapse" href="#jemaat" aria-expanded="false" aria-controls="jemaat" class="side-nav-link">
                                <i class="uil-clipboard-alt"></i>
                                <span>Jemaat</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse {{ request()->routeIs('backend.jemaat*') ? 'show' : '' }}"  id="jemaat">
                                <ul class="side-nav-second-level">
                                    <li class="{{ request()->routeIs('backend.jemaat*') ? 'menuitem-active' : '' }}">
                                        <a href="{{route('backend.jemaat')}}">Data Jemaat</a>
                                    </li>
                                    <li class="{{ request()->routeIs('backend.keluarga*') ? 'menuitem-active' : '' }}">
                                        <a href="{{route('backend.keluarga')}}">Data Keluarga</a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        <li class="side-nav-item {{ Request::is('backend/kas*') ? 'menuitem-active' : '' }}">
                            <a href="{{route('kas.index')}}" class="side-nav-link">
                                <i class="uil-wallet"></i>
                                <span>Kas</span>
                            </a>
                        </li>

                        <li class="side-nav-item {{ request()->routeIs('backend.akun*') ? 'menuitem-active' : '' }}">
                            <a href="{{route('backend.akun')}}" class="side-nav-link">
                                <i class=" uil-user"></i>
                                <span>Akun</span>
                            </a>
                        </li>
                    @endif
                        <li class="side-nav-title side-nav-item">Keluar</li>


                         <li class="side-nav-item">
                            <a href="{{route('logout')}}" class="side-nav-link">
                                <i class="uil-sign-out-alt"></i>
                                <span> Keluar</span>
                            </a>
                        </li>



                    </ul>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->


