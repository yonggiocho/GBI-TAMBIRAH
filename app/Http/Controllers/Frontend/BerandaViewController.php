<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class BerandaViewController extends Controller
{
    public function index()
    {
        $visimisi = DB::table('visi_misi')->first();
        $wartas = DB::table('wartas')->orderBy('created_at', 'desc')->limit(3)->get();
        $pengurus = DB::table('pengurus')->limit(4)->get();


        return view('frontend.beranda.index', compact('visimisi', 'wartas','pengurus'));
    }
}
