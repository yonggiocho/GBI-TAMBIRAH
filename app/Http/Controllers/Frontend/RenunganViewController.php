<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Renungan;
use Illuminate\Support\Facades\DB;


class RenunganViewController extends Controller
{
    public function renungan()
    {
        $renungans = Renungan::latest()->paginate(6);
        return view('frontend.renungan.index', [
            'breadcrumbs' => ['Beranda', 'Renungan'],
            'renungans' => $renungans
        ]);
    }

    public function detail($slug)
    {

        $renungan = Renungan::where('slug', $slug)->first();
        $renungans = Renungan::orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get();

        if (!$renungan) {
            abort(404); // redirect ke 404 jika tidak ada
        }
        return view('frontend.renungan.renungan-detail', [
            'breadcrumbs' => ['Beranda', 'Renungan', 'Detail'],
            'renungan' => [$renungan, $renungans],

        ]);
    }
}
