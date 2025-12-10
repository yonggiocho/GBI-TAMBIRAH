<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfilViewController extends Controller
{
    public function sejarahView()
    {
        $data = DB::table('sejarah')->first();
        return view('frontend.profil.index', [
            'sejarah' => $data,
            'breadcrumbs' => ['Beranda', 'Profil', 'Sejarah']
        ]);
    }

    public function visiMisiView()
    {
        $data = DB::table('visi_misi')->first();
        return view('frontend.profil.visi-misi', [
            'teks' => $data,
            'breadcrumbs' => ['Beranda', 'Profil', 'Visi-Misi']
        ]);
    }

    public function pengurusView()
    {
        $data = DB::table('pengurus')->get();
        return view('frontend.profil.pengurus', [
            'pengurus' => $data,
            'breadcrumbs' => ['Beranda', 'Profil', 'Pengurus']
        ]);
    }
}
