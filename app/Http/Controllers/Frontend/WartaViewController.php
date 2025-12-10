<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warta;
use Illuminate\Support\Facades\DB;

class WartaViewController extends Controller
{

    public function warta()
    {
        $wartas = Warta::latest()->paginate(6);
        return view('frontend.warta.index', [
            'breadcrumbs' => ['Beranda', 'Warta'],
            'wartas' => $wartas
        ]);
    }

    public function detail($slug)
    {

        $warta = Warta::where('slug', $slug)->first();
        $wartas = Warta::orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

        if (!$warta) {
            abort(404); // redirect ke 404 jika tidak ada
        }
        return view('frontend.warta.warta-detail', [
            'breadcrumbs' => ['Beranda', 'Warta', 'Detail'],
            'warta' => [$warta, $wartas],

        ]);
    }
}
