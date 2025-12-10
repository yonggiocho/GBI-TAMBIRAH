<?php

namespace App\Http\Controllers\Backend\Profil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class ProfilController extends Controller
{
    function generateId()
    {
        return 'pgrs_' . uniqid() . bin2hex(random_bytes(4));
    }

    //fungsi sejara
    function sejarahIndex()
    {
        $data = DB::table('sejarah')->first();
        return view('backend.profil.sejarah.sejarah', [
            'sejarah' => $data
        ]);
    }

    public function sejarahCreate()
    {
        return view('backend.profil.sejarah.sejarah-add');
    }

    function sejarahStore(Request $request,)
    {

        $validasi = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string'
        ]);

        DB::table('sejarah')
            ->insert([
                'judul' => $validasi['judul'],
                'isi'  => $validasi['isi'],
                'gambar' => 'Null',
                'created_at' => now(),
                'updated_at' => now()
            ]);

        Alert::toast('Data tersimpan', 'success')->autoClose(5000);
        return redirect()->route('backend.sejarah');
    }


    public function sejarahEdit(string $id)
    {
        $sejarah = DB::table('sejarah')->where('id', $id)->first();
        return view('backend.profil.sejarah.sejarah-edit', [
        'sejarah' => $sejarah
        ]);

    }

    function sejarahUpdate(Request $request, string $id)
    {

        $validasi = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string'
        ]);

        DB::table('sejarah')
            ->where('id', $id)
            ->update([
                'judul' => $validasi['judul'],
                'isi'  => $validasi['isi'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

        Alert::toast('Data tersimpan', 'success')->autoClose(5000);
        return redirect()->route('backend.sejarah');
    }




    //fungsi visi-misi
    function visiMisiIndex()
    {
        $visimisi = DB::table('visi_misi')->first();
        return view('backend.profil.visi-misi.visi-misi', [
            'visimisi' => $visimisi
        ]);
    }

    public function visiMisiCreate()
    {
        return view('backend.profil.visi-misi.visimisi-add');
    }


     function visiMisiStore(Request $request)
     {

        $validasi = $request->validate([
            'teks_visi' => 'required|string',
            'teks_misi' => 'required|string'
        ]);

        DB::table('visi_misi')
            ->insert([
                'teks_visi' => $validasi['teks_visi'],
                'teks_misi'  => $validasi['teks_misi'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

        Alert::toast('Data tersimpan', 'success')->autoClose(5000);
        return redirect()->route('backend.visi-misi');
    }

    public function visiMisiEdit(string $id)
    {
        $visimisi = DB::table('visi_misi')->where('id', $id)->first();
        return view('backend.profil.visi-misi.visimisi-edit', [
        'visimisi' => $visimisi
        ]);

    }




     function visiMisiUpdate(Request $request, string $id)
    {

        $validasi = $request->validate([
            'teks_visi' => 'required|string',
            'teks_misi' => 'required|string'
        ]);

        DB::table('visi_misi')
            ->where('id', $id)
            ->update([
                'teks_visi' => $validasi['teks_visi'],
                'teks_misi'  => $validasi['teks_misi'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        Alert::toast('Data tersimpan', 'success')->autoClose(5000);
        return redirect()->route('backend.visi-misi');
    }




    //fungsi pengurus
    public function pengurusIndex()
    {
        $data = DB::table('pengurus')->get();
        return $data ? view('backend.profil.pengurus.pengurus',
        [
            'pengurus' => $data
        ]) : abort(404);
    }

    public function pengurusCreate()
    {
        return view('backend.profil.pengurus.pengurus-add');
    }

    public function pengurusStore(Request $request)
    {
        $validasiData = $request->validate([
            'nama' => 'required|string|max:255',
            'gelar_depan' => 'string|max:6',
            'gelar_belakang' => 'string|max:6',
            'jabatan' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $urutan = DB::table('pengurus')->max('urutan') ?? 0;
        $validasiData['id'] = 'pgrs_' . Str::uuid();
        $validasiData['urutan'] = $urutan + 1;

          if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $filename = 'pengurus-'.uniqid().'.'.$file->extension();
                $path = Storage::disk('public')->putFileAs('pengurus', $file, $filename );
                $validasiData['gambar'] = $path;
          }else{
                $validasiData['gambar'] = '/img/no_image.jpg';
          }

          $validasiData['created_at'] = now();
          $validasiData['updated_at'] = now();

        DB::table('pengurus')->insert($validasiData);

        Alert::toast('Data Pengurus berhasil disimpan', 'success')->autoClose(5000);
        return redirect()->route('backend.pengurus');

    }

    public function pengurusEdit(string $id)
    {
        $dataPengurus = DB::table('pengurus')->where('id', $id)->first();
        return $dataPengurus ? view('backend.profil.pengurus.pengurus-edit', [
        'pengurus' => $dataPengurus
        ]) : abort(404);

    }

    public function pengurusUpdate(Request $request, string $id)
    {

        $validasiData = $request->validate([
            'nama' => 'required|string|max:255',
            'gelar_depan' => 'string|max:6',
            'gelar_belakang' => 'string|max:6',
            'jabatan' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $pengurus = DB::table('pengurus')->where('id', $id)->first();

        if(!$pengurus) {
            abort(404);
        }

        $validasiData['urutan'] = $pengurus->urutan;

          if ($request->hasFile('gambar')) {

                if ($pengurus->gambar !== '/img/no_image.jpg' &&  Storage::disk('public')->exists($pengurus->gambar)) {
                        Storage::disk('public')->delete($pengurus->gambar);
                }

                $file = $request->file('gambar');
                $filename ='pengurus-'.uniqid().'.'.$file->extension();
                $path = Storage::disk('public')->putFileAs( 'pengurus', $file, $filename);
                $validasiData['gambar'] = $path;
          }


        $validasiData['updated_at'] = now();

        DB::table('pengurus')->where('id', $id)->update($validasiData);

        Alert::toast('Data Pengurus berhasil diubah', 'success')->autoClose(5000);
        return redirect()->route('backend.pengurus');

    }


    public function pengurusDelete(string $id)
    {
        $pengurus = DB::table('pengurus')->where('id', $id)->first();

        if ($pengurus->gambar !== '/img/no_image.jpg' &&  Storage::disk('public')->exists($pengurus->gambar)) {
            Storage::disk('public')->delete($pengurus->gambar);
        }

        DB::table('pengurus')->where('id', $id)->delete();

        Alert::success('Terhapus', 'Data berhasil dihapus!');
        return redirect()->route('backend.pengurus');

    }










}
