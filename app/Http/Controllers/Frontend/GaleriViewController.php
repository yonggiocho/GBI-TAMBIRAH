<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Facades\DB;

class GaleriViewController extends Controller
{
    public function galeri()
    {
        $galeris = Galeri::latest()->paginate(6);
        return view('frontend.galeri.index', [
            'breadcrumbs' => ['Beranda', 'Galeri'],
            'galeris' => $galeris
        ]);
    }

}
