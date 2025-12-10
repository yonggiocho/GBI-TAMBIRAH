<?php

namespace App\Http\Controllers\Backend\Kas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KasTahun;
use App\Models\KasBulan;
use App\Models\KasTransaksi;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;

class KasController extends Controller
{
    private function toastSuccess($msg)
    {
        Alert::toast($msg, 'success')->autoClose(5000);
    }

    private function filterInput($input)
    {
        return strip_tags($input);
    }

    private static function namaBulan()
    {
        return [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

    }


    public function index()
    {
        $tahun = KasTahun::orderBy('tahun', 'desc')->get();
        return view('backend.kas.tahun', compact('tahun'));
    }

    public function tambahTahun(Request $request)
    {
        $request->validate(['tahun' => 'required|integer|unique:kas_tahun']);
        KasTahun::create(['tahun' => $this->filterInput($request->tahun)]);
        $this->toastSuccess('Data tahun berhasil dibuat');
        return back();
    }

    public function showBulan($tahunId)
    {
        $tahun = KasTahun::findOrFail($tahunId);
        $bulan = $tahun->kasBulan()->orderBy('bulan')->get();
        $namaBulan =  static::namaBulan();
        return view('backend.kas.bulan', compact('tahun', 'bulan','namaBulan'));
    }

    public function tambahBulan(Request $request, $tahunId)
    {

        $request->validate([
            'bulan' => [
                'required',
                'integer',
                'min:1',
                'max:12',
                 Rule::unique('kas_bulan', 'bulan')
                    ->where(fn ($query) => $query->where('tahun_id', $tahunId)),
            ],

        ]);

        $bulanSebelumnya = KasBulan::where('tahun_id', $tahunId)
                        ->where('bulan', $this->filterInput($request->bulan) - 1)
                        ->first();

        $saldoAwal = $bulanSebelumnya ? $bulanSebelumnya->saldo_akhir : 0;

            KasBulan::create([
                'tahun_id' => $tahunId,
                'bulan' => $this->filterInput($request->bulan),
                'saldo_awal' => $this->filterInput($saldoAwal),
                'saldo_akhir' => $this->filterInput($saldoAwal),
            ]);


        return back()->with('success', 'Bulan berhasil ditambahkan.');
    }

    public function showTransaksi($tahunId, $bulanId)
    {
        $bulan = KasBulan::findOrFail($bulanId);
        $namaBulan = static::namaBulan();
        $transaksi = $bulan->kasTransaksi()->orderBy('tanggal', 'asc')->get(); //fungsi ambil data KasTransaksi dari relasi model KasBulan
        $saldo_awal = $bulan->saldo_awal;


        $pemasukan = $transaksi->where('jenis', 'pemasukan')->sum('jumlah');
        $pengeluaran = $transaksi->where('jenis', 'pengeluaran')->sum('jumlah');
        $saldo = $bulan->saldo_awal + $pemasukan - $pengeluaran;

        return view('backend.kas.transaksi', compact('saldo_awal','namaBulan','bulan', 'transaksi', 'pemasukan', 'pengeluaran', 'saldo'));
    }

    public function storeTransaksi(Request $request, $tahunId, $bulanId)
    {
        $request->validate([
            'tanggal' => 'required|integer|min:1|max:31',
            'bulan'   => 'required|integer|min:1|max:12',
            'tahun'   => 'required|integer|min:2000',
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'keterangan' => 'required|string',
            'jumlah' => 'required|numeric|min:0',
        ],
        [
            'tanggal.required' => 'Tanggal wajib diisi',
            'jenis.required' => 'Jenis transaksi wajib dipilih',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
            'jumlah.required' => 'Nominal tidak boleh kosong',

        ]);

        $tanggalLengkap = Carbon::createFromDate( $request->tahun, $request->bulan,$request->tanggal)->format('Y-m-d');

        $transaksi = KasTransaksi::create([
            'bulan_id' => $bulanId,
            'tanggal' => $this->filterInput($tanggalLengkap),
            'jenis' => $this->filterInput($request->jenis),
            'keterangan' => $this->filterInput($request->keterangan),
            'jumlah' => $this->filterInput($request->jumlah),
        ]);

        $kasBulan = $transaksi->transaksiBulan;
        $totalMasuk = $kasBulan->kasTransaksi()->where('jenis', 'pemasukan')->sum('jumlah');
        $totalKeluar = $kasBulan->kasTransaksi()->where('jenis', 'pengeluaran')->sum('jumlah');
        $saldoAkhir = $kasBulan->saldo_awal + $totalMasuk - $totalKeluar;

        $kasBulan->update(['saldo_akhir' => $this->filterInput($saldoAkhir)]);

        $this->toastSuccess('Transaksi berhasil');
        return back();
    }
    public function updateStatusKas($idBulan, string $status)
    {
        $bulan = KasBulan::findOrfail($idBulan);
        $bulan->update(['status' => $status ]);
        $this->toastSuccess('Status transaksi berakhir');
        return back();
    }

    public function exportKas($bulanId)
    {
        $bulan = KasBulan::findOrFail($bulanId);
        $namaBulan = static::namaBulan();
        $transaksi = $bulan->kasTransaksi()->orderBy('tanggal', 'asc')->get(); //fungsi ambil data KasTransaksi dari relasi model KasBulan
        $saldo_awal = $bulan->saldo_awal;

        $pemasukan = $transaksi->where('jenis', 'pemasukan')->sum('jumlah');
        $pengeluaran = $transaksi->where('jenis', 'pengeluaran')->sum('jumlah');
        $saldo = $bulan->saldo_awal + $pemasukan - $pengeluaran;


        $pdf = Pdf::loadView('backend.kas.transaksi-export', [
            'saldo_awal' => $saldo_awal,
            'namaBulan' => $namaBulan,
            'bulan'     => $bulan,
            'transaksi' => $transaksi,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'saldo' => $saldo
            ])->setPaper('a4', 'potrait');
        return $pdf->stream('export-transaksi.pdf');
    }


    public function destroyTransaksi(string $id)
    {
        $kas = KasTransaksi::findOrFail($id);
        $kasBulan = $kas->transaksiBulan;
        $kas->delete();

        Alert::success('Terhapus', 'Data Transaksi berhasil dihapus');
        return back();

    }
}
