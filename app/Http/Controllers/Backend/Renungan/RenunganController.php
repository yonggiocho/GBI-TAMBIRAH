<?php

namespace App\Http\Controllers\Backend\Renungan;


use App\Models\Renungan;
use App\Models\KategoriRenungan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;


class RenunganController extends Controller
{

    private function filterInput($input)
    {
        return strip_tags($input, '<p><ul><li><b><o:p>');
    }

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
            while (Renungan::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            return $slug;
        }


    public function index()
    {
        $renungans = Renungan::latest()->get();
        return view('backend.renungan.renungan', compact('renungans'));
    }

    public function create()
    {
        $kategoris = KategoriRenungan::orderBy('slug', 'asc')->get();
        return view('backend.renungan.renungan-add',compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validasiData = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

          if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $filename = 'renungan-'.uniqid().'.'.$file->extension();
                $path = Storage::disk('public')->putFileAs('renungan', $file, $filename);
                $validasiData['gambar'] = $path;
          }else{
                $validasiData['gambar'] = '/img/no_image.jpg';
          }


           Renungan::create([
            'judul' => strip_tags($validasiData['judul']),
            'slug' => $this->makeSlug($validasiData['judul']),
            'kategori' => strip_tags($validasiData['kategori']),
            'isi' => $this->filterInput($validasiData['isi']),
            'penulis' => auth()->user()->name,
            'gambar' => $validasiData['gambar']
            ]);


        $this->toastSuccess('Data berhasil disimpan');

        return redirect()->route('backend.renungan');
    }

    public function edit(string $id)
    {
        $renungan = Renungan::findOrFail($id);
        $kategoris = KategoriRenungan::orderBy('slug', 'asc')->get();
        return view('backend.renungan.renungan-edit', compact('renungan','kategoris'));
    }

    public function updateStatus(string $id, string $status)
    {

        $renungan = Renungan::findOrFail($id);
        $renungan->update([
                'status' => $status,
        ]);

        return redirect()->route('backend.renungan');
    }


    public function update(Request $request, string $id)
    {
        $validasiData = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $renungan = Renungan::findOrFail($id);
          if ($request->hasFile('gambar')){

                if ($renungan->gambar !== '/img/no_image.jpg' && Storage::disk('public')->exists($renungan->gambar)) {
                        Storage::disk('public')->delete($renungan->gambar);
                }

                $file = $request->file('gambar');
                $filename = 'renungan-'.uniqid().'.'.$file->extension();
                $path = Storage::disk('public')->putFileAs( 'renungan', $file, $filename);
                $validasiData['gambar'] = $path;

          }else{
                $validasiData['gambar'] = $renungan->gambar;
          }

           $renungan->update([
                'judul' => strip_tags($validasiData['judul']),
                'slug' => $this->makeSlug($validasiData['judul']),
                'kategori' => strip_tags($validasiData['kategori']),
                'isi' => $this->filterInput($validasiData['isi']),
                'gambar' => $validasiData['gambar']
            ]);


        $this->toastSuccess('Data berhasil diubah');

        return redirect()->route('backend.renungan');
    }


     public function destroy(string $id)
     {
        $renungan = Renungan::findOrFail($id);

        if ($renungan->gambar !== '/img/no_image.jpg' && Storage::disk('public')->exists($renungan->gambar)) {
            Storage::disk('public')->delete($renungan->gambar);
        }

        $renungan->delete();

        Alert::success('Terhapus', 'Renungan berhasil dihapus');
        return redirect()->route('backend.renungan');
    }




}
