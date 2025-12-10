<?php

namespace App\Http\Controllers\Backend\Galeri;


use App\Models\Galeri;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
     function makeSlug($judul)
        {
            $slug = Str::slug(strtolower($judul), '-');
            $originalSlug = $slug;
            $counter = 1;

            // cek apakah slug sudah ada di database
            while (Galeri::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            return $slug;
        }



    public function index()
    {
        $galeris = Galeri::latest()->get();
        return view('backend.galeri.galeri', compact('galeris'));
    }

    public function create()
    {
        $kategori = ['pengumuman','kegiatan', 'jemaat'];
        return view('backend.galeri.galeri-add', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validasiData = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required',
            'kategori' => 'required|in:pengumuman,kegiatan,jemaat',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

          if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $filename = 'galeri-'.uniqid().'.'.$file->extension();
                $path = Storage::disk('public')->putFileAs('galeri', $file, $filename);
                $validasiData['gambar'] = $path;
          }else{
                $validasiData['gambar'] = '/img/no_image.jpg';
          }

           Galeri::create([
            'judul' => $validasiData['judul'],
            'slug' => $this->makeSlug($validasiData['judul']),
            'tanggal' => $validasiData['tanggal'],
            'kategori' => $validasiData['kategori'],
            'gambar' => $validasiData['gambar']
            ]);


        Alert::toast('Gambar berhasil disimpan', 'success')->autoClose(5000);
        return redirect()->route('backend.galeri');
    }

    public function edit(string $id)
    {
        $galeri = Galeri::findOrFail($id);
        $kategori = ['pengumuman','kegiatan', 'jemaat'];
        return view('backend.galeri.galeri-edit', compact('galeri','kategori'));

    }

    public function update(Request $request, string $id)
    {
        $validasiData = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required',
            'kategori' => 'required|in:pengumuman,kegiatan,jemaat',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $galeri = Galeri::findOrFail($id);

          if ($request->hasFile('gambar')){

                if ($galeri->gambar !== '/img/no_image.jpg' && Storage::disk('public')->exists($galeri->gambar)) {
                        Storage::disk('public')->delete($galeri->gambar);
                }

                $file = $request->file('gambar');
                $filename = 'galeri-'.uniqid().'.'.$file->extension();
                $path = Storage::disk('public')->putFileAs( 'galeri', $file, $filename);
                $validasiData['gambar'] = $path;

          }else{
                $validasiData['gambar'] = $galeri->gambar;
          }

           $galeri->update([
                'judul' => $validasiData['judul'],
                'slug' => $this->makeSlug($validasiData['judul']),
                'tanggal' => $validasiData['tanggal'],
                'kategori' =>$validasiData['kategori'],
                'gambar' => $validasiData['gambar']
            ]);


        Alert::toast('Gambar berhasil diubah', 'success')->autoClose(5000);
        return redirect()->route('backend.galeri');
    }

     public function destroy(string $id)
     {
        $galeri = Galeri::findOrFail($id);

        if ($galeri->gambar !== '/img/no_image.jpg' && Storage::disk('public')->exists($galeri->gambar)) {
            Storage::disk('public')->delete($galeri->gambar);
        }

        $galeri->delete();

        Alert::success('Terhapus', 'Gambar berhasil dihapus');
        return redirect()->route('backend.galeri');
    }

}
