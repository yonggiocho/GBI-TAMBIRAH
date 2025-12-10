<?php

namespace App\Http\Controllers\Backend\Warta;

use App\Models\Warta;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class WartaController extends Controller
{
    private function filterInput($input)
    {
        return strip_tags($input, '<p><ul><li><b><o:p>');
    }

    private function makeSlug($judul)
        {
            $slug = Str::slug(strtolower($judul), '-');
            $originalSlug = $slug;
            $counter = 1;

            // cek apakah slug sudah ada di database
            while (Warta::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            return $slug;
        }



    public function index()
    {
        $wartas = Warta::latest()->get();
        return view('backend.warta.warta', compact('wartas'));
    }

    public function create()
    {
        $kategori = ['pengumuman','kegiatan', 'jemaat'];
        return view('backend.warta.warta-add', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validasiData = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|in:pengumuman,kegiatan,jemaat',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'

        ]);

          if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $filename = 'warta-'.uniqid().'.'.$file->extension();
                $path = Storage::disk('public')->putFileAs('warta', $file, $filename);
                $validasiData['gambar'] = $path;
          }else{
                $validasiData['gambar'] = '/img/no_image.jpg';
          }


           Warta::create([
            'judul' => strip_tags($validasiData['judul']),
            'slug' => $this->makeSlug($validasiData['judul']),
            'kategori' => strip_tags($validasiData['kategori']),
            'isi' => $this->filterInput($validasiData['isi']),
            'penulis' => auth()->user()->name,
            'gambar' => $validasiData['gambar']
            ]);


        Alert::toast('Data berhasil disimpan', 'success')->autoClose(5000);
        return redirect()->route('backend.warta');
    }

    public function edit(string $id)
    {
        $warta = Warta::findOrFail($id);
        $kategori = ['pengumuman','kegiatan', 'jemaat'];
        return view('backend.warta.warta-edit', compact('warta', 'kategori'));

    }

    public function updateStatus(string $id, string $status)
    {

        $warta = Warta::findOrFail($id);
        $warta->update([
                'status' => $status,
        ]);

        return redirect()->route('backend.warta');
    }

    public function update(Request $request, string $id)
    {
        $validasiData = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|in:pengumuman,kegiatan,jemaat',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $warta = Warta::findOrFail($id);

          if ($request->hasFile('gambar')){

                if ($warta->gambar !== '/img/no_image.jpg' && Storage::disk('public')->exists($warta->gambar)) {
                        Storage::disk('public')->delete($warta->gambar);
                }

                $file = $request->file('gambar');
                $filename = 'warta-'.uniqid().'.'.$file->extension();
                $path = Storage::disk('public')->putFileAs( 'warta', $file, $filename);
                $validasiData['gambar'] = $path;

          }else{
                $validasiData['gambar'] = $warta->gambar;
          }

           $warta->update([
                'judul' => strip_tags($validasiData['judul']),
                'slug' => $this->makeSlug($validasiData['judul']),
                'kategori' => $validasiData['kategori'],
                'isi' => $this->filterInput($validasiData['isi']),
                'gambar' => $validasiData['gambar']
            ]);


        Alert::toast('Data berhasil diubah', 'success')->autoClose(5000);
        return redirect()->route('backend.warta');
    }

     public function destroy(string $id)
     {
        $warta = Warta::findOrFail($id);

        if ($warta->gambar !== '/img/no_image.jpg' && Storage::disk('public')->exists($warta->gambar)) {
            Storage::disk('public')->delete($warta->gambar);
        }

        $warta->delete();

        Alert::success('Terhapus', 'Warta berhasil dihapus');
        return redirect()->route('backend.warta');
    }




}
