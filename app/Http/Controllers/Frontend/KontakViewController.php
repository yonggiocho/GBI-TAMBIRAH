<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Identitas;

class KontakViewController extends Controller
{
    public function kontak()
    {
        $kontak = Identitas::first();
        return view('frontend.kontak.index', [
            'breadcrumbs' => ['Beranda', 'Kontak'],
            'kontak' => $kontak
        ]);
    }
}
