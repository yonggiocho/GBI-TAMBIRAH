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
        $renungans = Renungan::latest()->paginate(5);

        $kategoriRenungans =  DB::table('kategori_renungan')
            ->leftJoin('renungans', 'kategori_renungan.kategori', '=', 'renungans.kategori')
            ->select('kategori_renungan.kategori',
                DB::raw('COUNT(renungans.kategori) as total')
            )
            ->groupBy('kategori_renungan.kategori')
            ->get();


        return view('frontend.renungan.index', [
            'breadcrumbs' => ['Beranda', 'Renungan'],
            'renungans' => $renungans,
            'kategoriRenungans' => $kategoriRenungans
        ]);
    }

    public function renunganKategori($kategori)
    {
        $renungans = Renungan::where('kategori', $kategori)
                    ->orderBy('created_at', 'desc')
                    ->paginate(6);

        $kategoriRenungans =  DB::table('kategori_renungan')
            ->leftJoin('renungans', 'kategori_renungan.kategori', '=', 'renungans.kategori')
            ->select('kategori_renungan.kategori',
                DB::raw('COUNT(renungans.kategori) as total')
            )
            ->groupBy('kategori_renungan.kategori')
            ->get();

        return view('frontend.renungan.renungan-kategori',[
            'breadcrumbs' => ['Beranda', 'Renungan'],
            'renungans' => $renungans,
            'kategoriRenungans' => $kategoriRenungans,
            'kategori' => $kategori
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
