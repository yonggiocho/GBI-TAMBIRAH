<?php

namespace App\Http\Controllers\Backend\Jemaat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jemaat;
use App\Models\Keluarga;
use App\Models\AnggotaKeluarga;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;

class JemaatController extends Controller
{
    public function showJemaat()
    {
        $jemaats = Jemaat::orderBy('nama', 'asc')->get();
        return view('backend.jemaat.jemaat-index', compact('jemaats'));
    }

    public function createJemaat()
    {
        return view('backend.jemaat.jemaat-add');
    }

    public function storeJemaat(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'tempat_lahir' => 'required|max:100',
            'tanggal_lahir' => 'required|date',
            'email' => 'nullable|email',
            'no_hp' => 'nullable|numeric',
            'alamat' => 'required',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'status_baptis' => 'required|in:Sudah,Belum',
            'keterangan' => 'nullable'
        ]);


        Jemaat::create([
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_baptis' => $request->status_baptis,
            'keterangan' => $request->keterangan

        ]);

        Alert::toast('Data berhasil ditambah', 'success')->autoClose(5000);
        return redirect()->route('backend.jemaat');
    }

    public function editJemaat(string $id)
    {
        $jemaat = Jemaat::findOrfail($id);
        return view('backend.jemaat.jemaat-edit', compact('jemaat'));

    }

    public function updateJemaat(Request $request, string $id)
    {
        $jemaat = Jemaat::findOrfail($id);

        $validate = $request->validate([
            'nama' => 'required|max:100',
            'tempat_lahir' => 'required|max:100',
            'tanggal_lahir' => 'required|date',
            'email' => 'required|email',
            'no_hp' => 'required|numeric',
            'alamat' => 'required',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'status_baptis' => 'required|in:Sudah,Belum',
            'keterangan' => 'required'
        ]);


        $jemaat->update($validate);

        Alert::toast('Data berhasil diubah', 'success')->autoClose(5000);
        return redirect()->route('backend.jemaat');
    }

    public function detailJemaat(string $id)
    {
        $jemaat = Jemaat::findOrfail($id);
        return view('backend.jemaat.jemaat-detail', compact('jemaat'));

    }

    public function destroy(string $id)
     {
        $jemaat = Jemaat::findOrFail($id);
        $jemaat->delete();
        Alert::success('Terhapus', 'Data berhasil dihapus');
        return redirect()->route('backend.jemaat');
    }


    public function showKeluarga()
    {
        $keluargas = Keluarga::with(['jemaatKeluarga','anggota.jemaat'])->get();
        return view('backend.jemaat.keluarga-index', compact('keluargas'));
    }


    public function createKeluarga()
    {
        $jemaats = Jemaat::select('id', 'nama')->orderBy('nama', 'asc')->get();
        return view('backend.jemaat.keluarga-add', compact('jemaats'));
    }

    public function storeKeluarga(Request $request)
    {
        $validated = $request->validate([
            'kepala_keluarga' => 'required|string|max:100',
            'jemaat_id' => [ 'required', 'exists:jemaat,id',
                        function ($attribute, $value, $fail) {

                                    if (Keluarga::where('jemaat_id', $value)->exists()) {
                                        $fail('Jemaat sudah menjadi kepala keluarga.');
                                    }

                                    if (AnggotaKeluarga::where('jemaat_id', $value)->exists()) {
                                        $fail('Jemaat sudah menjadi anggota keluarga lain.');
                                    }
                                },
                            ],
            'anggota' => 'nullable|array',
            'anggota.*.jemaat_id' => ['required','exists:jemaat,id',
                        function ($attribute, $value, $fail) {

                            if (Keluarga::where('jemaat_id', $value)->exists()) {
                                $fail('Jemaat sudah menjadi kepala keluarga.');
                            }

                            if (AnggotaKeluarga::where('jemaat_id', $value)->exists()) {
                                $fail('Jemaat sudah menjadi anggota keluarga lain.');
                            }
                        },
                    ],
            'anggota.*.hubungan'  => 'required|string|in:Istri,Anak,Lainnya|max:50',

        ]);

        $keluarga = Keluarga::create([
            'kepala_keluarga' => $request->kepala_keluarga,
            'jemaat_id' => $request->jemaat_id,
        ]);

        if (!empty($validated['anggota'])){
            foreach ($validated['anggota'] as $anggota) {
                        AnggotaKeluarga::create([
                            'keluarga_id' => $keluarga->id,
                            'jemaat_id'   => $anggota['jemaat_id'],
                            'hubungan'    => $anggota['hubungan'],
                        ]);
            }
        }

        Alert::success('Berhasil', 'Data berhasil ditambah');
        return redirect()->route('backend.keluarga');

    }

     public function editKeluarga($id)
    {
        $keluarga = Keluarga::with('anggota')->findOrFail($id);
        $jemaats  = Jemaat::all();

        return view('backend.jemaat.keluarga-edit', compact('keluarga', 'jemaats'));
    }

    public function updateKeluarga(Request $request, $id)
    {
        $request->validate([
            'kepala_keluarga' => 'required|string|max:100',
            'jemaat_id'       => 'nullable|exists:jemaat,id',
            'anggota'         => 'array|nullable',
            'anggota.*.jemaat_id' => 'required|exists:jemaat,id',
            'anggota.*.hubungan'  => 'required|string|in:Suami,Istri,Anak,Orang Tua,Lainnya|max:50',

        ]);

        $keluarga = Keluarga::findOrFail($id);

        $keluarga->update([
            'kepala_keluarga' => $request->kepala_keluarga,
            'jemaat_id'       => $request->jemaat_id,
        ]);


        $keluarga->anggota()->delete();

        if ($request->has('anggota')) {
            foreach ($request->anggota as $anggota) {
                AnggotaKeluarga::create([
                    'keluarga_id' => $keluarga->id,
                    'jemaat_id'   => $anggota['jemaat_id'],
                    'hubungan'    => $anggota['hubungan'],
                ]);
            }
        }

        return redirect()->route('backend.keluarga');

    }

    public function exportKeluarga()
    {
        $keluargas = Keluarga::with(['jemaatKeluarga','anggota.jemaat'])->get();
        $pdf = Pdf::loadView('backend.jemaat.keluarga-export', ['keluargas' => $keluargas])->setPaper('a4', 'landscape');
        return $pdf->stream('export-data-keluarga.pdf');
    }

    public function destroyKeluarga($id)
    {
        $keluarga = Keluarga::with('anggota')->findOrFail($id);

        $keluarga->anggota()->delete();
        $keluarga->delete();
        Alert::success('Terhapus', 'Data Keluarga berhasil dihapus');
        return redirect()->route('backend.keluarga');
    }

}
