<?php

namespace App\Http\Controllers\Backend\Renungan;


use App\Models\KategoriRenungan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class RenunganKategoriController extends Controller
{

    function toastSuccess($msg)
    {
         Alert::toast($msg, 'success')->autoClose(5000);
    }

    private function makeSlug($judul)
    {
            $slug = Str::slug(strtolower($judul), '-');
            $originalSlug = $slug;
            $counter = 1;

            // cek apakah slug sudah ada di database
            while (KategoriRenungan::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            return $slug;
    }


    public function index()
    {
        $kategoris = KategoriRenungan::orderBy('slug', 'asc')->get();
        return view('backend.renungan.kategori.kategori', compact('kategoris'));
    }

    public function create()
    {
        return view('backend.renungan.kategori.kategori-add');
    }

    public function store(Request $request)
    {
        $validasiData = $request->validate([
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

          if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $filename = 'thumbnail-'.uniqid().'.'.$file->extension();
                $path = Storage::disk('public')->putFileAs('renungan/thumbnail', $file, $filename);
                $validasiData['thumbnail'] = $path;
          }else{
                $validasiData['thumbnail'] = '/img/no_image.jpg';
          }


           KategoriRenungan::create([
            'kategori' => strip_tags($validasiData['kategori']),
            'slug' => $this->makeSlug($validasiData['kategori']),
            'deskripsi' => strip_tags($validasiData['deskripsi']),
            'thumbnail' => $validasiData['thumbnail']
            ]);


        $this->toastSuccess('Data berhasil disimpan');

        return redirect()->route('backend.kategori.renungan');
    }

    public function edit(string $id)
    {
        $kategori = KategoriRenungan::findOrFail($id);
        return view('backend.renungan.kategori.kategori-edit', compact('kategori'));
    }

    public function update(Request $request, string $id)
    {
        $validasiData = $request->validate([
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $kategori = KategoriRenungan::findOrFail($id);
          if ($request->hasFile('thumbnail')){

                if ($kategori->thumbnail !== '/img/no_image.jpg' && Storage::disk('public')->exists($kategori->thumbnail)) {
                        Storage::disk('public')->delete($kategori->thumbnail);
                }

                $file = $request->file('thumbnail');
                $filename = 'thumbnail-'.uniqid().'.'.$file->extension();
                $path = Storage::disk('public')->putFileAs( 'renungan/thumbnail', $file, $filename);
                $validasiData['thumbnail'] = $path;

          }else{
                $validasiData['thumbnail'] = $kategori->thumbnail;
          }

           $kategori->update([
                'kategori' => strip_tags($validasiData['kategori']),
                'slug' => $this->makeSlug($validasiData['kategori']),
                'deskripsi' => strip_tags($validasiData['deskripsi']),
                'thumbnail' => $validasiData['thumbnail']
            ]);


        $this->toastSuccess('Data berhasil diubah');

        return redirect()->route('backend.kategori.renungan');
    }


    public function destroy(string $id)
    {
        $kategori = KategoriRenungan::findOrFail($id);

        if ($kategori->thumbnail !== '/img/no_image.jpg' && Storage::disk('public')->exists($kategori->thumbnail)) {
            Storage::disk('public')->delete($kategori->thumbnail);
        }

        $kategori->delete();

        Alert::success('Terhapus', 'Kategori berhasil dihapus');
        return redirect()->route('backend.kategori.renungan');
    }


}
