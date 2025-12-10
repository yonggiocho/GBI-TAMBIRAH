<?php

namespace App\Http\Controllers\Backend\Beranda;

use App\Models\Warta;
use App\Models\Renungan;
use App\Models\Galeri;
use App\Models\User;
use App\Models\Jemaat;
use App\Models\Keluarga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $warta = Warta::count();
        $renungan = Renungan::count();
        $galeri = Galeri::count();
        $akun = User::count();
        $jemaat = Jemaat::count();
        $keluarga = Keluarga::count();
        return view('backend.beranda.index', compact('warta','renungan','galeri','akun','jemaat', 'keluarga'));
    }
}
