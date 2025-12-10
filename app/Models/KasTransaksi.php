<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KasBulan;

class KasTransaksi extends Model
{
    protected $table = 'kas_transaksi';
    protected $fillable = ['bulan_id', 'tanggal', 'jenis', 'keterangan', 'jumlah'];

    public function transaksiBulan()
    {
        return $this->belongsTo(KasBulan::class, 'bulan_id');
    }
}
